<?php
/**
 * Ti Flushdashboard
 *
 * @category    Ti
 * @package     Ti_Flushdashboard
 * @copyright   Copyright (c) 2012 Ti Technologies (http://www.titechnologies.in)
 * @link        http://www.titechnologies.in
 */
class Ti_Flushdashboard_Adminhtml_FlushdashboardController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
      public function addAction()
    {

        $write = Mage::getSingleton('core/resource')->getConnection('core_write');

        $tables = array();
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_order');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_order_address');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_order_grid');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_order_item');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_order_status_history');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_quote');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_quote_address');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_quote_address_item');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_quote_item');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_quote_item_option');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_order_payment');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_quote_payment');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_shipment');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_shipment_item');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_invoice');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_invoice_grid');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_flat_invoice_item');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sendfriend_log');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('tag');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('tag_relation');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('tag_summary');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('wishlist');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('log_quote');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('report_event');
        $write->query("SET FOREIGN_KEY_CHECKS=0;");
        foreach($tables as $table) :
            $write->query("truncate table `$table`");
            $write->query("ALTER TABLE `$table` AUTO_INCREMENT=1");
        endforeach;
        $tables[] = Mage::getSingleton('core/resource')->getTableName('catalogsearch_result');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('catalogsearch_query');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_bestsellers_aggregated_daily');
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_bestsellers_aggregated_monthly') ;
        $tables[] = Mage::getSingleton('core/resource')->getTableName('sales_bestsellers_aggregated_yearly');

        foreach($tables as $table) :
            $write->query("truncate table `$table`");
        endforeach;


    $condition = array($write->quoteInto('event_type_id=?', '1'));
    $write->delete('report_event', $condition);
    Mage::getSingleton('core/session')->addSuccess($this->__('You have successfully flushed the following dashboard datas!!'));
    $this->_redirect('*/*');



    }
}
