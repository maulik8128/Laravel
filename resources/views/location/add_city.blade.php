<h2>Add City</h2>
@form([
        'route'=>route('location.store.city'),
        'formId' =>'add',
        'submit_name' =>'Create',
        'submit_btn_id'=>'submit',
        // 'class' => '',
    ])
        @formInput([
            'lable'=>'City',
            'input_name'=>'city_name',
            'item' =>'city',
            'required'=>true,
            'validation'=> 'minlenght="2"'
        ])
        @endformInput
        @formSelect([
            'lable'=>'Country',
            'input_name'=>'country_id',
            'item' =>'region',
            'required'=>true,
            'items' => $data['country'],
            'item_name'=> 'country_name',
            'class' =>'getRegion'
        ])
        @endformSelect
        @formSelect([
            'lable'=>'Region',
            'input_name'=>'region_id',
            'item' =>'region',
            'required'=>true,
            'items' => '',
            'item_name'=> 'region_name'
        ])
        @endformSelect
@endform
