<h2>Add User</h2>
@form([
        'route'=>route('location.store.country'),
        'formId' =>'add',
        'submit_name' =>'Create',
        'submit_btn_id'=>'submit',
        // 'class' => '',
    ])
        @formInput([
            'lable'=>'Country',
            'input_name'=>'country_name',
            'item' =>'contry',
            'required'=>true,
            'validation'=> 'minlenght="2"'
        ])
        @endformInput
@endform
