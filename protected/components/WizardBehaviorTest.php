<?php 
class WizardBehavior extends CBehavior{
	
	const OPCION_SKIP = 0;
	const OPCION_DESELECT = 2;
	const OPCION_SELECT = 1;
	
	public $pasos = array();
	public $forwardAdelante= false;
	private  $_pasoActual;
	
	
	public $eventos = array(
			'onFinalizar'=>'wizardFinalizado',
			'onPasoEnProceso'=>'PasoEnProceso',
			'onInicar'=>'wizardInicar',
			'onPasoNoValido'=>'wizardPasoNoValido'
	 );
	
	
	
	public function attach($owner) {
		if (!$owner instanceof CController)
			throw new CException(Yii::t('wizard', 'Owner must be an instance of CController'));
	
		parent::attach($owner);
		foreach($this->eventos as $event=>$handler)
			$this->attachEventHandler($event,array($owner,$handler));
	}
	
	public function process($paso=null)
	{
		if(empty($paso))
		{
			$this->siguientePaso();
		}
		$event = new WizardEvent($this);
		$this->onSeguir($event);
	
		return $event->handled;
	}
	
	protected function siguientePaso()
	{
		$url = array($this->owner->id.'/'.$this->getOwner()->getAction()->getId(), 'pasos'=>$pasos[0]);
		$this->owner->redirect($this->owner->createUrl);
	}
	
	public function onAmigos($event) {
		$this->raiseEvent('onAmigos', $event);
	}
	
	public function onSeguir($event) {
		$this->raiseEvent('onSeguir', $event);
	}
	
	public function onInformacion($event)
	{
		$this->raiseEvent('onInformacion', $event);
	}
}

/**
 * Wizard event class.
 * This is the event raised by the wizard.
 */
class WizardEvent extends CEvent {
	private $data=array();
	private $step;

	public function __construct($sender, $step=null, $data=null) {
		parent::__construct($sender);
		$this->step = $step;
		$this->data = $data;
	}

	public function getData() {
		return $this->data;
	}

	public function getStep() {
		return $this->step;
	}
}
?>