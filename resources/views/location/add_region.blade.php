<h2>Add Region</h2>
@form([
        'route'=>route('location.store.region'),
        'formId' =>'add',
        'submit_name' =>'Create',
        'submit_btn_id'=>'submit',
        // 'class' => '',
    ])
        @formInput([
            'lable'=>'Region',
            'input_name'=>'region_name',
            'item' =>'region',
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
            'item_name'=> 'country_name'
        ])
        @endformSelect


@endform
