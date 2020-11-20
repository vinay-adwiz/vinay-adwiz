<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Plans controller
 */
class Plans extends Front_Controller
{
    protected $permissionCreate = 'Plans.Plans.Create';
    protected $permissionDelete = 'Plans.Plans.Delete';
    protected $permissionEdit   = 'Plans.Plans.Edit';
    protected $permissionView   = 'Plans.Plans.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('plans/plans_model');
        $this->lang->load('plans');
        
        

        Assets::add_module_js('plans', 'plans.js');
    }

    /**
     * Display a list of Plans data.
     *
     * @return void
     */
    public function index()
    {
        
        
        
        
        $records = $this->plans_model->find_all();

        Template::set('records', $records);
        

        Template::render();
    }
    
}