<?php

/**
 * Description of Sale
 *
 * @author pahhan
 */
class Domstor_List_Commerce_Sale extends Domstor_List_Supply
{
	protected $show_square_house=false;
	protected $show_square_ground=false;

	public function checkSquare()
	{
		if( !is_array($this->data) ) return FALSE;
		foreach( $this->data as $a )
		{
			if( isset($a['Purposes'][1009]) and $a['Purposes'][1009] )
			{

				if( count($a['Purposes'])==1 )
				{
					$this->show_square_ground=true;
				}
				else
				{
					$this->show_square_ground=true;
					$this->show_square_house=true;
					return;
				}
			}
			else
			{
				$this->show_square_house=true;
			}
		}
	}

	public function __construct($attr)
	{
		parent::__construct($attr);

		$this->getField('address')->setTitle('��������������');
		$this->deleteField('district');
		$type_field = new Domstor_List_Field_Commerce_Purpose( array(
			'name'=>'type',
			'title'=>'����������',
			'css_class'=>'domstor_type',
			'sort_name'=>'sort-purpose',
			'position'=>100,
		) );

		$address_field = new Domstor_List_Field_Commerce_Address( array(
			'name'=>'address',
			'title'=>'��������������',
			'css_class'=>'domstor_address',
			'in_region'=>$this->in_region,
			'object_href'=>$this->object_href,
			'sort_name'=>'sort-location',
			'position'=>230,
		));

		$floor_field = new Domstor_List_Field_Commerce_Floor( array(
			'name'=>'floor',
			'title'=>'����',
			'css_class'=>'domstor_floor',
			'position'=>231,
		) );

		$square_field = new Domstor_List_Field_Commerce_Square( array(
			'name'=>'square_house',
			'title'=>'�������',
			'css_class'=>'domstor_square_house',
			'sort_name'=>'sort-square',
			'position'=>232,
		) );

		$square_ground_field = new Domstor_List_Field_Commerce_SquareGround( array(
			'name'=>'square_ground',
			'title'=>'������� ���������� �������',
			'css_class'=>'domstor_square_ground',
			'sort_name'=>'sort-groundsq',
			'position'=>233,
		) );

		$price_field = new Domstor_List_Field_Commerce_Price( array(
			'name'=>'price',
			'css_class'=>'domstor_price',
			'action'=>$this->action,
			'sort_name'=>'sort-price',
			'position'=>260,

		) );

		$this->checkSquare();
		$this->addField($type_field)
			 ->addField($floor_field)
			 ->addField($price_field)
			 ->addField($address_field)
		;
		if( $this->show_square_house ) $this->addField($square_field);
		if( $this->show_square_ground ) $this->addField($square_ground_field);
		if( $this->in_region )
		{
			$this->deleteField('district');
		}
		if( $this->action=='rent' )$this->getField('price')->setSortName('sort-rent');
	}
}