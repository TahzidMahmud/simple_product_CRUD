<template>
  <form>
  <div class="row">
    <div class="form-group col-md-8">
        <label for="exampleFormControlInput1">Product Name</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Put Product Name Here..">
    </div>
    <div class="form-group col-md-4">
        <label for="exampleFormControlInput1">Brand (Optional)</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Put Product Name Here..">
    </div>
  </div>
  <div class="row">
      <div class="form-group col-md-6">
        <label for="exampleFormControlSelect1">Select Category</label>
        <select class="form-control" id="exampleFormControlSelect1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="exampleFormControlSelect1">Select Sub-ategory</label>
        <select class="form-control" id="exampleFormControlSelect1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        </select>
    </div>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Product Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
</form>
</template>

<script>
export default {

}
</script>

<style>

</style>
