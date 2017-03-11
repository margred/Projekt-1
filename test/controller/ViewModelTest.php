<?php

use HAWMS\controller\ViewModel;

class ViewModelTest extends \PHPUnit\Framework\TestCase
{
    const VIEW_NAME = 'aView';

    /**
     * @var ViewModel
     */
    private $viewModel;

    protected function setUp()
    {
        $this->viewModel = new ViewModel(self::VIEW_NAME);
    }

    public function testShouldReturnViewName()
    {
        $this->assertEquals(self::VIEW_NAME, $this->viewModel->getViewName());
    }

    public function testShouldSetModelToEmptyArray()
    {
        $viewModel = new ViewModel(self::VIEW_NAME);

        $this->assertNotNull($viewModel->getModel());
        $this->assertTrue(empty($viewModel->getModel()));
    }
}
