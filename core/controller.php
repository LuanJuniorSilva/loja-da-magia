<?php
class controller
{
	public function loadView($viewName, $viewData = array())
	{
		extract($viewData);
		require 'views/' . $viewName . '.php';
	}

	public function loadViewInTemplate($viewName, $viewData = array())
	{
		extract($viewData);
		require 'views/' . $viewName . '.php';
	}

	public function loadViewPainel($viewName, $viewData = array())
	{
		extract($viewData);
		require 'views/admin/' . $viewName . '.php';
	}
}
