

@extends('layouts.app')

@section('title', 'Add Post')
@section('content')

<div class="row">
    <div class="col-4">
        <h2>Data Manipulation Task</h2>
        @form([
            'route'=>route('Exceldata.createData'),
            'formId' =>'add',
            'submit_name' =>'Create',
            'submit_btn_id'=>'submit',
            // 'class' => '',
        ])
            @formInputWithValue([
                'lable'=>'Id',
                'input_name'=>'Id',
                'required'=>true,
                'input_name_value'=> 'Id'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'Name',
                'input_name'=>'Name',
                'required'=>true,
                'input_name_value'=> 'Name'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ShortDescription',
                'input_name'=>'ShortDescription',
                'required'=>true,
                'input_name_value'=> 'ShortDescription'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'FullDescription',
                'input_name'=>'FullDescription',
                'required'=>true,
                'input_name_value'=> 'FullDescription'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AdminComment',
                'input_name'=>'AdminComment',
                'required'=>true,
                'input_name_value'=> 'AdminComment'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ShowOnHomePage',
                'input_name'=>'ShowOnHomePage',
                'required'=>true,
                'input_name_value'=> 'ShowOnHomePage'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MetaKeywords',
                'input_name'=>'MetaKeywords',
                'required'=>true,
                'input_name_value'=> 'MetaKeywords'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MetaDescription',
                'input_name'=>'MetaDescription',
                'required'=>true,
                'input_name_value'=> 'MetaDescription'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MetaTitle',
                'input_name'=>'MetaTitle',
                'required'=>true,
                'input_name_value'=> 'MetaTitle'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AllowCustomerReviews',
                'input_name'=>'AllowCustomerReviews',
                'required'=>true,
                'input_name_value'=> 'AllowCustomerReviews'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ApprovedRatingSum',
                'input_name'=>'ApprovedRatingSum',
                'required'=>true,
                'input_name_value'=> 'ApprovedRatingSum'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'NotApprovedRatingSum',
                'input_name'=>'NotApprovedRatingSum',
                'required'=>true,
                'input_name_value'=> 'NotApprovedRatingSum'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ApprovedTotalReviews',
                'input_name'=>'ApprovedTotalReviews',
                'required'=>true,
                'input_name_value'=> 'ApprovedTotalReviews'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'NotApprovedTotalReviews',
                'input_name'=>'NotApprovedTotalReviews',
                'required'=>true,
                'input_name_value'=> 'NotApprovedTotalReviews'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'Published',
                'input_name'=>'Published',
                'required'=>true,
                'input_name_value'=> 'Published'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'Deleted',
                'input_name'=>'Deleted',
                'required'=>true,
                'input_name_value'=> 'Deleted'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'CreatedOnUtc',
                'input_name'=>'CreatedOnUtc',
                'required'=>true,
                'input_name_value'=> 'CreatedOnUtc'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'UpdatedOnUtc',
                'input_name'=>'UpdatedOnUtc',
                'required'=>true,
                'input_name_value'=> 'UpdatedOnUtc'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ProductTemplateId',
                'input_name'=>'ProductTemplateId',
                'required'=>true,
                'input_name_value'=> 'ProductTemplateId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'SubjectToAcl',
                'input_name'=>'SubjectToAcl',
                'required'=>true,
                'input_name_value'=> 'SubjectToAcl'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'LimitedToStores',
                'input_name'=>'LimitedToStores',
                'required'=>true,
                'input_name_value'=> 'LimitedToStores'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'VendorId',
                'input_name'=>'VendorId',
                'required'=>true,
                'input_name_value'=> 'VendorId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ProductTypeId',
                'input_name'=>'ProductTypeId',
                'required'=>true,
                'input_name_value'=> 'ProductTypeId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ParentGroupedProductId',
                'input_name'=>'ParentGroupedProductId',
                'required'=>true,
                'input_name_value'=> 'ParentGroupedProductId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'SKU',
                'input_name'=>'SKU',
                'required'=>true,
                'input_name_value'=> 'SKU'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ManufacturerPartNumber',
                'input_name'=>'ManufacturerPartNumber',
                'required'=>true,
                'input_name_value'=> 'ManufacturerPartNumber'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'Gtin',
                'input_name'=>'Gtin',
                'required'=>true,
                'input_name_value'=> 'Gtin'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'IsGiftCard',
                'input_name'=>'IsGiftCard',
                'required'=>true,
                'input_name_value'=> 'IsGiftCard'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'GiftCardTypeId',
                'input_name'=>'GiftCardTypeId',
                'required'=>true,
                'input_name_value'=> 'GiftCardTypeId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'RequireOtherProducts',
                'input_name'=>'RequireOtherProducts',
                'required'=>true,
                'input_name_value'=> 'RequireOtherProducts'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'RequiredProductIds',
                'input_name'=>'RequiredProductIds',
                'required'=>true,
                'input_name_value'=> 'RequiredProductIds'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AutomaticallyAddRequiredProducts',
                'input_name'=>'AutomaticallyAddRequiredProducts',
                'required'=>true,
                'input_name_value'=> 'AutomaticallyAddRequiredProducts'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'IsDownload',
                'input_name'=>'IsDownload',
                'required'=>true,
                'input_name_value'=> 'IsDownload'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'DownloadId',
                'input_name'=>'DownloadId',
                'required'=>true,
                'input_name_value'=> 'DownloadId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'UnlimitedDownloads',
                'input_name'=>'UnlimitedDownloads',
                'required'=>true,
                'input_name_value'=> 'UnlimitedDownloads'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MaxNumberOfDownloads',
                'input_name'=>'MaxNumberOfDownloads',
                'required'=>true,
                'input_name_value'=> 'MaxNumberOfDownloads'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'DownloadExpirationDays',
                'input_name'=>'DownloadExpirationDays',
                'required'=>true,
                'input_name_value'=> 'DownloadExpirationDays'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'DownloadActivationTypeId',
                'input_name'=>'DownloadActivationTypeId',
                'required'=>true,
                'input_name_value'=> 'DownloadActivationTypeId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'HasSampleDownload',
                'input_name'=>'HasSampleDownload',
                'required'=>true,
                'input_name_value'=> 'HasSampleDownload'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'SampleDownloadId',
                'input_name'=>'SampleDownloadId',
                'required'=>true,
                'input_name_value'=> 'SampleDownloadId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'HasUserAgreement',
                'input_name'=>'HasUserAgreement',
                'required'=>true,
                'input_name_value'=> 'HasUserAgreement'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'UserAgreementText',
                'input_name'=>'UserAgreementText',
                'required'=>true,
                'input_name_value'=> 'UserAgreementText'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'IsRecurring',
                'input_name'=>'IsRecurring',
                'required'=>true,
                'input_name_value'=> 'IsRecurring'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'RecurringCycleLength',
                'input_name'=>'RecurringCycleLength',
                'required'=>true,
                'input_name_value'=> 'RecurringCycleLength'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'RecurringCyclePeriodId',
                'input_name'=>'RecurringCyclePeriodId',
                'required'=>true,
                'input_name_value'=> 'RecurringCyclePeriodId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'RecurringTotalCycles',
                'input_name'=>'RecurringTotalCycles',
                'required'=>true,
                'input_name_value'=> 'RecurringTotalCycles'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'IsShipEnabled',
                'input_name'=>'IsShipEnabled',
                'required'=>true,
                'input_name_value'=> 'IsShipEnabled'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'IsFreeShipping',
                'input_name'=>'IsFreeShipping',
                'required'=>true,
                'input_name_value'=> 'IsFreeShipping'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AdditionalShippingCharge',
                'input_name'=>'AdditionalShippingCharge',
                'required'=>true,
                'input_name_value'=> 'AdditionalShippingCharge'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'IsTaxExempt',
                'input_name'=>'IsTaxExempt',
                'required'=>true,
                'input_name_value'=> 'IsTaxExempt'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'TaxCategoryId',
                'input_name'=>'TaxCategoryId',
                'required'=>true,
                'input_name_value'=> 'TaxCategoryId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ManageInventoryMethodId',
                'input_name'=>'ManageInventoryMethodId',
                'required'=>true,
                'input_name_value'=> 'ManageInventoryMethodId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'StockQuantity',
                'input_name'=>'StockQuantity',
                'required'=>true,
                'input_name_value'=> 'StockQuantity'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'DisplayStockAvailability',
                'input_name'=>'DisplayStockAvailability',
                'required'=>true,
                'input_name_value'=> 'DisplayStockAvailability'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'DisplayStockQuantity',
                'input_name'=>'DisplayStockQuantity',
                'required'=>true,
                'input_name_value'=> 'DisplayStockQuantity'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MinStockQuantity',
                'input_name'=>'MinStockQuantity',
                'required'=>true,
                'input_name_value'=> 'MinStockQuantity'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'LowStockActivityId',
                'input_name'=>'LowStockActivityId',
                'required'=>true,
                'input_name_value'=> 'LowStockActivityId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'NotifyAdminForQuantityBelow',
                'input_name'=>'NotifyAdminForQuantityBelow',
                'required'=>true,
                'input_name_value'=> 'NotifyAdminForQuantityBelow'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'BackorderModeId',
                'input_name'=>'BackorderModeId',
                'required'=>true,
                'input_name_value'=> 'BackorderModeId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AllowBackInStockSubscriptions',
                'input_name'=>'AllowBackInStockSubscriptions',
                'required'=>true,
                'input_name_value'=> 'AllowBackInStockSubscriptions'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'OrderMinimumQuantity',
                'input_name'=>'OrderMinimumQuantity',
                'required'=>true,
                'input_name_value'=> 'OrderMinimumQuantity'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'OrderMaximumQuantity',
                'input_name'=>'OrderMaximumQuantity',
                'required'=>true,
                'input_name_value'=> 'OrderMaximumQuantity'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AllowedQuantities',
                'input_name'=>'AllowedQuantities',
                'required'=>true,
                'input_name_value'=> 'AllowedQuantities'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'DisableBuyButton',
                'input_name'=>'DisableBuyButton',
                'required'=>true,
                'input_name_value'=> 'DisableBuyButton'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ProductTemplateId',
                'input_name'=>'ProductTemplateId',
                'required'=>true,
                'input_name_value'=> 'ProductTemplateId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'DisableWishlistButton',
                'input_name'=>'DisableWishlistButton',
                'required'=>true,
                'input_name_value'=> 'DisableWishlistButton'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AvailableForPreOrder',
                'input_name'=>'AvailableForPreOrder',
                'required'=>true,
                'input_name_value'=> 'AvailableForPreOrder'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'CallForPrice',
                'input_name'=>'CallForPrice',
                'required'=>true,
                'input_name_value'=> 'CallForPrice'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'Price',
                'input_name'=>'Price',
                'required'=>true,
                'input_name_value'=> 'Price'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'OldPrice',
                'input_name'=>'OldPrice',
                'required'=>true,
                'input_name_value'=> 'OldPrice'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ProductCost',
                'input_name'=>'ProductCost',
                'required'=>true,
                'input_name_value'=> 'ProductCost'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'CustomerEntersPrice',
                'input_name'=>'CustomerEntersPrice',
                'required'=>true,
                'input_name_value'=> 'CustomerEntersPrice'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MinimumCustomerEnteredPrice',
                'input_name'=>'MinimumCustomerEnteredPrice',
                'required'=>true,
                'input_name_value'=> 'MinimumCustomerEnteredPrice'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MaximumCustomerEnteredPrice',
                'input_name'=>'MaximumCustomerEnteredPrice',
                'required'=>true,
                'input_name_value'=> 'MaximumCustomerEnteredPrice'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'HasTierPrices',
                'input_name'=>'HasTierPrices',
                'required'=>true,
                'input_name_value'=> 'HasTierPrices'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'HasDiscountsApplied',
                'input_name'=>'HasDiscountsApplied',
                'required'=>true,
                'input_name_value'=> 'HasDiscountsApplied'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'Weight',
                'input_name'=>'Weight',
                'required'=>true,
                'input_name_value'=> 'Weight'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'Length',
                'input_name'=>'Length',
                'required'=>true,
                'input_name_value'=> 'Length'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'Width',
                'input_name'=>'Width',
                'required'=>true,
                'input_name_value'=> 'Width'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'Height',
                'input_name'=>'Height',
                'required'=>true,
                'input_name_value'=> 'Height'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AvailableStartDateTimeUtc',
                'input_name'=>'AvailableStartDateTimeUtc',
                'required'=>true,
                'input_name_value'=> 'AvailableStartDateTimeUtc'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AvailableEndDateTimeUtc',
                'input_name'=>'AvailableEndDateTimeUtc',
                'required'=>true,
                'input_name_value'=> 'AvailableEndDateTimeUtc'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'VisibleIndividually',
                'input_name'=>'VisibleIndividually',
                'required'=>true,
                'input_name_value'=> 'VisibleIndividually'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'DisplayOrder',
                'input_name'=>'DisplayOrder',
                'required'=>true,
                'input_name_value'=> 'DisplayOrder'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'PreOrderAvailabilityStartDateTimeUtc',
                'input_name'=>'PreOrderAvailabilityStartDateTimeUtc',
                'required'=>true,
                'input_name_value'=> 'PreOrderAvailabilityStartDateTimeUtc'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'DeliveryDateId',
                'input_name'=>'DeliveryDateId',
                'required'=>true,
                'input_name_value'=> 'DeliveryDateId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'WarehouseId',
                'input_name'=>'WarehouseId',
                'required'=>true,
                'input_name_value'=> 'WarehouseId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'AllowAddingOnlyExistingAttributeCombinations',
                'input_name'=>'AllowAddingOnlyExistingAttributeCombinations',
                'required'=>true,
                'input_name_value'=> 'AllowAddingOnlyExistingAttributeCombinations'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ShipSeparately',
                'input_name'=>'ShipSeparately',
                'required'=>true,
                'input_name_value'=> 'ShipSeparately'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'UseMultipleWarehouses',
                'input_name'=>'UseMultipleWarehouses',
                'required'=>true,
                'input_name_value'=> 'UseMultipleWarehouses'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'IsRental',
                'input_name'=>'IsRental',
                'required'=>true,
                'input_name_value'=> 'IsRental'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'RentalPriceLength',
                'input_name'=>'RentalPriceLength',
                'required'=>true,
                'input_name_value'=> 'RentalPriceLength'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'IsTelecommunicationsOrBroadcastingOrElectronicServices',
                'input_name'=>'IsTelecommunicationsOrBroadcastingOrElectronicServices',
                'required'=>true,
                'input_name_value'=> 'IsTelecommunicationsOrBroadcastingOrElectronicServices'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'BasepriceEnabled',
                'input_name'=>'BasepriceEnabled',
                'required'=>true,
                'input_name_value'=> 'BasepriceEnabled'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'BasepriceAmount',
                'input_name'=>'BasepriceAmount',
                'required'=>true,
                'input_name_value'=> 'BasepriceAmount'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'BasepriceUnitId',
                'input_name'=>'BasepriceUnitId',
                'required'=>true,
                'input_name_value'=> 'BasepriceUnitId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'BasepriceBaseAmount',
                'input_name'=>'BasepriceBaseAmount',
                'required'=>true,
                'input_name_value'=> 'BasepriceBaseAmount'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'BasepriceBaseUnitId',
                'input_name'=>'BasepriceBaseUnitId',
                'required'=>true,
                'input_name_value'=> 'BasepriceBaseUnitId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'OverriddenGiftCardAmount',
                'input_name'=>'OverriddenGiftCardAmount',
                'required'=>true,
                'input_name_value'=> 'OverriddenGiftCardAmount'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MarkAsNew',
                'input_name'=>'MarkAsNew',
                'required'=>true,
                'input_name_value'=> 'MarkAsNew'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MarkAsNewStartDateTimeUtc',
                'input_name'=>'MarkAsNewStartDateTimeUtc',
                'required'=>true,
                'input_name_value'=> 'MarkAsNewStartDateTimeUtc'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'MarkAsNewEndDateTimeUtc',
                'input_name'=>'MarkAsNewEndDateTimeUtc',
                'required'=>true,
                'input_name_value'=> 'MarkAsNewEndDateTimeUtc'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'NotReturnable',
                'input_name'=>'NotReturnable',
                'required'=>true,
                'input_name_value'=> 'NotReturnable'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'ProductAvailabilityRangeId',
                'input_name'=>'ProductAvailabilityRangeId',
                'required'=>true,
                'input_name_value'=> 'ProductAvailabilityRangeId'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'bc_product_id',
                'input_name'=>'bc_product_id',
                'required'=>true,
                'input_name_value'=> 'bc_product_id'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'old_url',
                'input_name'=>'old_url',
                'required'=>true,
                'input_name_value'=> 'old_url'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'custom_url',
                'input_name'=>'custom_url',
                'required'=>true,
                'input_name_value'=> 'custom_url'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'status',
                'input_name'=>'status',
                'required'=>true,
                'input_name_value'=> 'status'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'message',
                'input_name'=>'message',
                'required'=>true,
                'input_name_value'=> 'message'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'img_status',
                'input_name'=>'img_status',
                'required'=>true,
                'input_name_value'=> 'img_status'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'update_status',
                'input_name'=>'update_status',
                'required'=>true,
                'input_name_value'=> 'update_status'
            ])
            @endformInputWithValue
            @formInputWithValue([
                'lable'=>'group_product_status',
                'input_name'=>'group_product_status',
                'required'=>true,
                'input_name_value'=> 'group_product_status'
            ])
            @endformInputWithValue

    @endform



    </div>
</div>

@endsection
