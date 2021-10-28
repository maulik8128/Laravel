<div class="form-group">
    <label for="product_name">Product Name</label>
    <input id="product_name" type="text" name="product_name" class="form-control required required"  value="{{ old('product_name', optional($product ?? null)->product_name) }}" >
    <span class="text-danger error-text  product_name_error"></span>
</div>
@error('product_name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <label for="product_description">Product Description</label>
    <textarea id="product_description" name="product_description" class="form-control required"cols="30" rows="2">{{ old('product_description', optional($product ?? null)->product_description) }}</textarea>
    <span class="text-danger error-text  product_description_error"></span>
</div>
@error('product_description')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <label for="product_price">Product Price</label>
    <input id="product_price" type="text" name="product_price" class="form-control required"  value="{{ old('product_price', optional($product ?? null)->product_price) }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
    <span class="text-danger error-text product_price_error"></span>
</div>
@error('product_price')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <label for="product_photo">Product Photo</label>
    <input id="product_photo" type="file" name="product_photo" class="form-control-file" accept='image/*'>
    <span class="text-danger error-text  product_photo_error"></span>
    <div class="img-holder"></div>
</div>
@error('product_photo')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <label for="opening_stock">Opening Stock</label>
    <input id="opening_stock" type="text" name="opening_stock" class="form-control required"  value="{{ old('opening_stock', optional($product->productStock ?? null)->opening_stock) }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
    <span class="text-danger error-text  opening_stock_error"></span>
</div>
@error('opening_stock')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
<div class="form-group">
    <label for="captcha">Captch</label>
    <div class="captcha">
        <span>{!!  captcha_img() !!}</span>
        <button type="button" class="btn btn-success btn-refresh">Refresh</button>
    </div>
    <input type="text" id="captcha" name="captcha" class="form-control required" >
    <span class="text-danger error-text  captcha_error"></span>
</div>
@error('opening_stock')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

