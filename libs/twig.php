<?php

namespace Libs;

/**
* Extend Twig Functionality and Filters
*/
class Twig extends \Twig_Extension
{
	 /**
     * @var \Slim\Interfaces\RouterInterface
     */
    private $router;

    /**
     * @var string|\Slim\Http\Uri
     */
    private $uri;

    public function __construct($router, $uri)
    {
        $this->router = $router;
        $this->uri = $uri;
    }

    public function getName()
    {
        return 'slim';
    }

    /**
     * Set the base url
     *
     * @param string|Slim\Http\Uri $baseUrl
     * @return void
     */
    public function setBaseUrl($baseUrl)
    {
        $this->uri = $baseUrl;
    }

    /*
     |--------------------------------------------------------------------------
     | Functions
     |--------------------------------------------------------------------------
     */

    public function getFunctions()
    {
        return [
        	new \Twig_SimpleFunction('path_is',  array($this, 'pathIs')),
            new \Twig_SimpleFunction('path_for', array($this, 'pathFor')),
            new \Twig_SimpleFunction('base_url', array($this, 'baseUrl')),
            new \Twig_SimpleFunction('session',  array($this,  'session')),
            new \Twig_SimpleFunction(
                'csrf',
                array($this, 'csrfField'),
                array(
                    'needs_context' => true,
                    'is_safe' => array('all')
                )
            )
        ];
    }

    public function session(string $key, bool $deep = false)
    {
        return Session::get($key, $deep);
    }

    public function pathIs($name, $data = [])
    {
        return $this->router->pathFor($name, $data) === $this->uri->getPath();
    }

    public function pathFor($name, $data = [], $queryParams = [], $appName = 'default')
    {
        return $this->router->pathFor($name, $data, $queryParams);
    }

    public function baseUrl()
    {
        if (is_string($this->uri)) {
            return $this->uri;
        }
        if (method_exists($this->uri, 'getBaseUrl')) {
            return $this->uri->getBaseUrl();
        }
    }

    public function csrfField($context)
    {
        $name  = "<input type='hidden' name='{$context['csrf']['nameKey']}' value='{$context['csrf']['name']}'>";
        $value = "<input type='hidden' name='{$context['csrf']['valueKey']}' value='{$context['csrf']['value']}'>";
        
        return $name.$value;
    }

    /*
     |--------------------------------------------------------------------------
     | Filters
     |--------------------------------------------------------------------------
     */

    public function getFilters()
	{
		return [
			new \Twig_SimpleFilter('truncate', array($this, 'truncateFilter')),
            new \Twig_SimpleFilter('currency', array($this, 'currencyFilter'))
		];
	}

	public function truncateFilter($value, $len = 30, $preserve = false, $sep = '...')
	{
		if (strlen($value) > $len) 
		{
			if ($preserve) 
			{
				if (false !== ($breakpoint = strpos($value, ' ', $len))) 
				{
					$len = $breakpoint;
				}
			}
			
			return rtrim(substr($value, 0, $len)).$sep;
		}
		
		return $value;
	}

	public function currencyFilter($num, $dec = 2, $sign = '$', $decSep = '.', $thousandSep = ',')
	{
		return $sign.number_format($num, $dec, $decSep, $thousandSep);
	}
}