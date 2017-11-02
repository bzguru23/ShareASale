<?php
namespace ShareASale\TrackAffiliates\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\LocalizedException as CoreException;

class Affiliate extends AbstractModel implements AffiliateInterface
{
	
  const CACHE_TAG = 'affiliate';
  
  
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ShareASale\TrackAffiliates\Model\ResourceModel\Affiliate');
    }

    /**
     * {@inheritdoc}
     */
    /*public function install(array $fixtures)
    {
        foreach ($fixtures as $file) {
            $fileName = $this->fixtureManager->getFixture($file);
            if (!file_exists($fileName)) {
                continue;
            }
            $rows = $this->csvReader->getData($fileName);
            $header = array_shift($rows);
            $isFirst = true;
            
            foreach ($rows as $row) {
                $data = [];
                foreach ($row as $key => $value) {
                    $data[$header[$key]] = $value;
                }
                $row = $data;
                
                if ($isFirst) {
                    //$customer = $this->customerRepository->get($row['customer_email']);
                    //$affiliate = $this->affiliateRepository->get($row['affiliate_email']);
                    //if (!$customer->getId()) {
                    //    continue;
                    //}
                    /** @var \Magento\Sales\Model\ResourceModel\Collection $orderCollection */
                    
      /*              $affiliateCollection = $this->affiliateCollectionFactory->create();
                    $affiliateCollection->addFilter('affiliate_id', $affiliate->getId());
                    if ($affiliateCollection->count() > 0) {
                        break;
                    }
                }
                
                /*
                $isFirst = false;
                $affiliateData = $this->converter->convertRow($row);
                $this->affiliateProcessor->createAffiliate($affiliateData);
                */
           // }
      //  }
  //  }
}