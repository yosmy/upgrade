<?php

namespace Yosmy;

/**
 * @di\service()
 */
class ExecuteUpgrade
{
    /**
     * @var ManageUpgradeCollection
     */
    private $manageUpgradeCollection;

    /**
     * @var Upgrade[]
     */
    private $upgradeServices;

    /**
     * @param ManageUpgradeCollection $manageUpgradeCollection
     * @param Upgrade[]               $upgradeServices
     *
     * @di\arguments({
     *     upgradeServices: '#yosmy.upgrade'
     * })
     */
    public function __construct(
        ManageUpgradeCollection $manageUpgradeCollection,
        array $upgradeServices
    )
    {
        $this->manageUpgradeCollection = $manageUpgradeCollection;
        $this->upgradeServices = $upgradeServices;
    }

    /**
     * @return string[]
     */
    public function execute(): array
    {
        $ids = [];

        ksort($this->upgradeServices);

        foreach ($this->upgradeServices as $key => $upgradeService) {
            $last = $this->getLastUpgrade();

            $result = $upgradeService->upgrade($last);

            if ($result == true) {
                $this->addUpgrade((string) $key);

                $ids[] = $key;
            }
        }

        return array_filter($ids);
    }

    /**
     * @return string|null
     */
    private function getLastUpgrade(): ?string
    {
        $upgrade = $this->manageUpgradeCollection->findOne(
            [],
            [
                'sort' => [
                    '_id' => -1
                ]
            ]
        );

        if ($upgrade == null) {
            return null;
        }

        return $upgrade->_id;
    }

    /**
     * @param string $id
     */
    private function addUpgrade(
        string $id
    ) {
        $this->manageUpgradeCollection->insertOne(
            ['_id' => $id]
        );
    }
}