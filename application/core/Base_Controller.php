<?PHP

require 'vendor/autoload.php';

use Philo\Blade\Blade;


class Base_Controller extends \CI_Controller
{

	/**
	 *@Blade
	 *
	 */
	protected $blade;

	protected $data;

	public function __construct()
	{
		parent::__construct();
		$this->blade = new Blade(VIEWPATH, APPPATH . '/cache/');
	}

	protected function view($view, $data = [], $return = false)
	{
		if (!empty($data)) {
			$this->data = array_merge($this->data, $data);
		} else {
			$this->data = [];
		}
		$blview = $this->blade->view()->make($view, $this->data)->render();
		if (!$return)
			return print($blview);
		return $blview;
	}
}
