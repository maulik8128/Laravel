<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExceldataFinal;
use App\Facades\CounterFacades;

class ExceldataController extends Controller
{
    protected $table_name = 'Exceldatas';


    public function createData(Request $request)
    {
        // $counter = new Counter(random_int(10,100));

        // $this->counter->increment();
            CounterFacades::increment();
            CounterFacades::increment();

        // $this->counter->increment();

        // $data = [  "Id" => "Id",
        //         "Name" => "Name",
        //         "ShortDescription" => "ShortDescription",
        //         "FullDescription" => "FullDescription",
        //         "AdminComment" => "AdminComment",
        //         "ShowOnHomePage" => "ShowOnHomePage",
        //         "MetaKeywords" => "MetaKeywords",
        //         "MetaDescription" => "MetaDescription",
        //         "MetaTitle" => "MetaTitle",
        //         "AllowCustomerReviews" => "AllowCustomerReviews",
        //         "ApprovedRatingSum" => "ApprovedRatingSum",
        //         "NotApprovedRatingSum" => "NotApprovedRatingSum",
        //         "ApprovedTotalReviews" => "ApprovedTotalReviews",
        //         "NotApprovedTotalReviews" => "NotApprovedTotalReviews",
        //         "Published" => "Published",
        //         "Deleted" => "Deleted",
        //         "CreatedOnUtc" => "CreatedOnUtc",
        //         "UpdatedOnUtc" => "UpdatedOnUtc",
        //         "ProductTemplateId" => "ProductTemplateId",
        //         "SubjectToAcl" => "SubjectToAcl",
        //         "LimitedToStores" => "LimitedToStores",
        //         "VendorId" => "VendorId",
        //         "ProductTypeId" => "ProductTypeId",
        //         "ParentGroupedProductId" => "ParentGroupedProductId",
        //         "SKU" => "SKU",
        //         "ManufacturerPartNumber" => "ManufacturerPartNumber",
        //         "Gtin" => "Gtin",
        //         "IsGiftCard" => "IsGiftCard",
        //         "GiftCardTypeId" => "GiftCardTypeId",
        //         "RequireOtherProducts" => "RequireOtherProducts",
        //         "RequiredProductIds" => "RequiredProductIds",
        //         "AutomaticallyAddRequiredProducts" => "AutomaticallyAddRequiredProducts",
        //         "IsDownload" => "IsDownload",
        //         "DownloadId" => "DownloadId",
        //         "UnlimitedDownloads" => "UnlimitedDownloads",
        //         "MaxNumberOfDownloads" => "MaxNumberOfDownloads",
        //         "DownloadExpirationDays" => "DownloadExpirationDays",
        //         "DownloadActivationTypeId" => "DownloadActivationTypeId",
        //         "HasSampleDownload" => "HasSampleDownload",
        //         "SampleDownloadId" => "SampleDownloadId",
        //         "HasUserAgreement" => "HasUserAgreement",
        //         "UserAgreementText" => "UserAgreementText",
        //         "IsRecurring" => "IsRecurring",
        //         "RecurringCycleLength" => "RecurringCycleLength",
        //         "RecurringCyclePeriodId" => "RecurringCyclePeriodId",
        //         "RecurringTotalCycles" => "RecurringTotalCycles",
        //         "IsShipEnabled" => "IsShipEnabled",
        //         "IsFreeShipping" => "IsFreeShipping",
        //         "AdditionalShippingCharge" => "AdditionalShippingCharge",
        //         "IsTaxExempt" => "IsTaxExempt",
        //         "TaxCategoryId" => "TaxCategoryId",
        //         "ManageInventoryMethodId" => "ManageInventoryMethodId",
        //         "StockQuantity" => "StockQuantity",
        //         "DisplayStockAvailability" => "DisplayStockAvailability",
        //         "DisplayStockQuantity" => "DisplayStockQuantity",
        //         "MinStockQuantity" => "MinStockQuantity",
        //         "LowStockActivityId" => "LowStockActivityId",
        //         "NotifyAdminForQuantityBelow" => "NotifyAdminForQuantityBelow",
        //         "BackorderModeId" => "BackorderModeId",
        //         "AllowBackInStockSubscriptions" => "AllowBackInStockSubscriptions",
        //         "OrderMinimumQuantity" => "OrderMinimumQuantity",
        //         "OrderMaximumQuantity" => "OrderMaximumQuantity",
        //         "AllowedQuantities" => "AllowedQuantities",
        //         "DisableBuyButton" => "DisableBuyButton",
        //         "DisableWishlistButton" => "DisableWishlistButton",
        //         "AvailableForPreOrder" => "AvailableForPreOrder",
        //         "CallForPrice" => "CallForPrice",
        //         "Price" => "Price",
        //         "OldPrice" => "OldPrice",
        //         "ProductCost" => "ProductCost",
        //         "CustomerEntersPrice" => "CustomerEntersPrice",
        //         "MinimumCustomerEnteredPrice" => "MinimumCustomerEnteredPrice",
        //         "MaximumCustomerEnteredPrice" => "MaximumCustomerEnteredPrice",
        //         "HasTierPrices" => "HasTierPrices",
        //         "HasDiscountsApplied" => "HasDiscountsApplied",
        //         "Weight" => "Weight",
        //         "Length" => "Length",
        //         "Width" => "Width",
        //         "Height" => "Height",
        //         "AvailableStartDateTimeUtc" => "AvailableStartDateTimeUtc",
        //         "AvailableEndDateTimeUtc" => "AvailableEndDateTimeUtc",
        //         "VisibleIndividually" => "VisibleIndividually",
        //         "DisplayOrder" => "DisplayOrder",
        //         "PreOrderAvailabilityStartDateTimeUtc" => "PreOrderAvailabilityStartDateTimeUtc",
        //         "DeliveryDateId" => "DeliveryDateId",
        //         "WarehouseId" => "WarehouseId",
        //         "AllowAddingOnlyExistingAttributeCombinations" => "AllowAddingOnlyExistingAttributeCombinations",
        //         "ShipSeparately" => "ShipSeparately",
        //         "UseMultipleWarehouses" => "UseMultipleWarehouses",
        //         "IsRental" => "IsRental",
        //         "RentalPriceLength" => "RentalPriceLength",
        //         "IsTelecommunicationsOrBroadcastingOrElectronicServices" => "IsTelecommunicationsOrBroadcastingOrElectronicServices",
        //         "BasepriceEnabled" => "BasepriceEnabled",
        //         "BasepriceAmount" => "BasepriceAmount",
        //         "BasepriceUnitId" => "BasepriceUnitId",
        //         "BasepriceBaseAmount" => "BasepriceBaseAmount",
        //         "BasepriceBaseUnitId" => "BasepriceBaseUnitId",
        //         "OverriddenGiftCardAmount" => "OverriddenGiftCardAmount",
        //         "MarkAsNew" => "MarkAsNew",
        //         "MarkAsNewStartDateTimeUtc" => "MarkAsNewStartDateTimeUtc",
        //         "MarkAsNewEndDateTimeUtc" => "MarkAsNewEndDateTimeUtc",
        //         "NotReturnable" => "NotReturnable",
        //         "ProductAvailabilityRangeId" => "ProductAvailabilityRangeId",
        //         "bc_product_id" => "bc_product_id",
        //         "old_url" => "old_url",
        //         "custom_url" => "custom_url",
        //         "status" => "status",
        //         "message" => "message",
        //         "img_status" => "img_status",
        //         "update_status" => "update_status",
        //         "group_product_status" => "group_product_status"];


        //         // foreach($data as $key=>$d){
        //         //     echo '$table->{"boolean"}($request->input("'.$key.'"));'."<br>";
        //         // }

        //         // dd();

        //             Schema::dropIfExists($this->table_name);
        //             if(!Schema::hasTable($this->table_name)){
        //                 Schema::create($this->table_name, function (Blueprint $table) use($request){
        //                     $table->bigIncrements($request->input('Id'));
        //                     $table->{"boolean"}($request->input("Name"));
        //                     $table->{"boolean"}($request->input("ShortDescription"));
        //                     $table->{"boolean"}($request->input("FullDescription"));
        //                     $table->{"boolean"}($request->input("AdminComment"));
        //                     $table->{"boolean"}($request->input("ShowOnHomePage"));
        //                     $table->{"boolean"}($request->input("MetaKeywords"));
        //                     $table->{"boolean"}($request->input("MetaDescription"));
        //                     $table->{"boolean"}($request->input("MetaTitle"));
        //                     $table->{"boolean"}($request->input("AllowCustomerReviews"));
        //                     $table->{"boolean"}($request->input("ApprovedRatingSum"));
        //                     $table->{"boolean"}($request->input("NotApprovedRatingSum"));
        //                     $table->{"boolean"}($request->input("ApprovedTotalReviews"));
        //                     $table->{"boolean"}($request->input("NotApprovedTotalReviews"));
        //                     $table->{"boolean"}($request->input("Published"));
        //                     $table->{"boolean"}($request->input("Deleted"));
        //                     $table->{"boolean"}($request->input("CreatedOnUtc"));
        //                     $table->{"boolean"}($request->input("UpdatedOnUtc"));
        //                     $table->{"boolean"}($request->input("ProductTemplateId"));
        //                     $table->{"boolean"}($request->input("SubjectToAcl"));
        //                     $table->{"boolean"}($request->input("LimitedToStores"));
        //                     $table->{"boolean"}($request->input("VendorId"));
        //                     $table->{"boolean"}($request->input("ProductTypeId"));
        //                     $table->{"boolean"}($request->input("ParentGroupedProductId"));
        //                     $table->{"boolean"}($request->input("SKU"));
        //                     $table->{"boolean"}($request->input("ManufacturerPartNumber"));
        //                     $table->{"boolean"}($request->input("Gtin"));
        //                     $table->{"boolean"}($request->input("IsGiftCard"));
        //                     $table->{"boolean"}($request->input("GiftCardTypeId"));
        //                     $table->{"boolean"}($request->input("RequireOtherProducts"));
        //                     $table->{"boolean"}($request->input("RequiredProductIds"));
        //                     $table->{"boolean"}($request->input("AutomaticallyAddRequiredProducts"));
        //                     $table->{"boolean"}($request->input("IsDownload"));
        //                     $table->{"boolean"}($request->input("DownloadId"));
        //                     $table->{"boolean"}($request->input("UnlimitedDownloads"));
        //                     $table->{"boolean"}($request->input("MaxNumberOfDownloads"));
        //                     $table->{"boolean"}($request->input("DownloadExpirationDays"));
        //                     $table->{"boolean"}($request->input("DownloadActivationTypeId"));
        //                     $table->{"boolean"}($request->input("HasSampleDownload"));
        //                     $table->{"boolean"}($request->input("SampleDownloadId"));
        //                     $table->{"boolean"}($request->input("HasUserAgreement"));
        //                     $table->{"boolean"}($request->input("UserAgreementText"));
        //                     $table->{"boolean"}($request->input("IsRecurring"));
        //                     $table->{"boolean"}($request->input("RecurringCycleLength"));
        //                     $table->{"boolean"}($request->input("RecurringCyclePeriodId"));
        //                     $table->{"boolean"}($request->input("RecurringTotalCycles"));
        //                     $table->{"boolean"}($request->input("IsShipEnabled"));
        //                     $table->{"boolean"}($request->input("IsFreeShipping"));
        //                     $table->{"boolean"}($request->input("AdditionalShippingCharge"));
        //                     $table->{"boolean"}($request->input("IsTaxExempt"));
        //                     $table->{"boolean"}($request->input("TaxCategoryId"));
        //                     $table->{"boolean"}($request->input("ManageInventoryMethodId"));
        //                     $table->{"boolean"}($request->input("StockQuantity"));
        //                     $table->{"boolean"}($request->input("DisplayStockAvailability"));
        //                     $table->{"boolean"}($request->input("DisplayStockQuantity"));
        //                     $table->{"boolean"}($request->input("MinStockQuantity"));
        //                     $table->{"boolean"}($request->input("LowStockActivityId"));
        //                     $table->{"boolean"}($request->input("NotifyAdminForQuantityBelow"));
        //                     $table->{"boolean"}($request->input("BackorderModeId"));
        //                     $table->{"boolean"}($request->input("AllowBackInStockSubscriptions"));
        //                     $table->{"boolean"}($request->input("OrderMinimumQuantity"));
        //                     $table->{"boolean"}($request->input("OrderMaximumQuantity"));
        //                     $table->{"boolean"}($request->input("AllowedQuantities"));
        //                     $table->{"boolean"}($request->input("DisableBuyButton"));
        //                     $table->{"boolean"}($request->input("DisableWishlistButton"));
        //                     $table->{"boolean"}($request->input("AvailableForPreOrder"));
        //                     $table->{"boolean"}($request->input("CallForPrice"));
        //                     $table->{"boolean"}($request->input("Price"));
        //                     $table->{"boolean"}($request->input("OldPrice"));
        //                     $table->{"boolean"}($request->input("ProductCost"));
        //                     $table->{"boolean"}($request->input("CustomerEntersPrice"));
        //                     $table->{"boolean"}($request->input("MinimumCustomerEnteredPrice"));
        //                     $table->{"boolean"}($request->input("MaximumCustomerEnteredPrice"));
        //                     $table->{"boolean"}($request->input("HasTierPrices"));
        //                     $table->{"boolean"}($request->input("HasDiscountsApplied"));
        //                     $table->{"boolean"}($request->input("Weight"));
        //                     $table->{"boolean"}($request->input("Length"));
        //                     $table->{"boolean"}($request->input("Width"));
        //                     $table->{"boolean"}($request->input("Height"));
        //                     $table->{"boolean"}($request->input("AvailableStartDateTimeUtc"));
        //                     $table->{"boolean"}($request->input("AvailableEndDateTimeUtc"));
        //                     $table->{"boolean"}($request->input("VisibleIndividually"));
        //                     $table->{"boolean"}($request->input("DisplayOrder"));
        //                     $table->{"boolean"}($request->input("PreOrderAvailabilityStartDateTimeUtc"));
        //                     $table->{"boolean"}($request->input("DeliveryDateId"));
        //                     $table->{"boolean"}($request->input("WarehouseId"));
        //                     $table->{"boolean"}($request->input("AllowAddingOnlyExistingAttributeCombinations"));
        //                     $table->{"boolean"}($request->input("ShipSeparately"));
        //                     $table->{"boolean"}($request->input("UseMultipleWarehouses"));
        //                     $table->{"boolean"}($request->input("IsRental"));
        //                     $table->{"boolean"}($request->input("RentalPriceLength"));
        //                     $table->{"boolean"}($request->input("IsTelecommunicationsOrBroadcastingOrElectronicServices"));
        //                     $table->{"boolean"}($request->input("BasepriceEnabled"));
        //                     $table->{"boolean"}($request->input("BasepriceAmount"));
        //                     $table->{"boolean"}($request->input("BasepriceUnitId"));
        //                     $table->{"boolean"}($request->input("BasepriceBaseAmount"));
        //                     $table->{"boolean"}($request->input("BasepriceBaseUnitId"));
        //                     $table->{"boolean"}($request->input("OverriddenGiftCardAmount"));
        //                     $table->{"boolean"}($request->input("MarkAsNew"));
        //                     $table->{"boolean"}($request->input("MarkAsNewStartDateTimeUtc"));
        //                     $table->{"boolean"}($request->input("MarkAsNewEndDateTimeUtc"));
        //                     $table->{"boolean"}($request->input("NotReturnable"));
        //                     $table->{"boolean"}($request->input("ProductAvailabilityRangeId"));
        //                     $table->{"boolean"}($request->input("bc_product_id"));
        //                     $table->{"boolean"}($request->input("old_url"));
        //                     $table->{"boolean"}($request->input("custom_url"));
        //                     $table->{"boolean"}($request->input("status"));
        //                     $table->{"boolean"}($request->input("message"));
        //                     $table->{"boolean"}($request->input("img_status"));
        //                     $table->{"boolean"}($request->input("update_status"));
        //                     $table->{"boolean"}($request->input("group_product_status"));

        //                     $table->timestamps();
        //                 });
        //                 $data = ['id'=>$request->input('id'),'name'=>$request->input('name')];
        //                 Excel::import(new ExceldataFinal($data),public_path('/data/data.csv'));

        //             }


            // $test = [2, 7, 0, 4, 3, 0, 5, 0];
            // $a=[];
            // $b=[];
            // foreach($test as $t){

            //     if($t >0){


    }
}
