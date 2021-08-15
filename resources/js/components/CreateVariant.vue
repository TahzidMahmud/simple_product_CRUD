<template>
<div>
  <h5 class="text text-center m-4">Create New Variants For " {{ product.product_name }} "</h5><hr>
  <form @submit="variantSubmission">
      <div class="row">
          <div class="form-group col-md-4 ">
              <label >Select Size</label>
              <div class="row">
                  <div class="col-md-8 col-sm-8">
                        <select class="form-control" v-model="size" required >
                         <option value="" selected>--Select--</option>
                         <option v-for="(size ,index) in sizes" :key="index" :value="size.id">{{size.name}}</option>

                        </select>
                  </div>
                  <button class="btn btn-primary col-md-4 col-sm-4" @click="create_size($event)">Add New</button>
              </div>
          </div>
          <div class="form-group col-md-4 ">
              <label >Select Color</label>
              <div class="row">
                  <div class="col-md-8 col-sm-8">
                        <select class="form-control" v-model="color" required >
                         <option value="" selected>--Select--</option>
                        <option v-for="(color ,index) in colors" :key="index" :value="color.id">{{color.name}}</option>
                        </select>
                  </div>
                  <button class="btn btn-primary col-md-4 col-sm-4" @click="create_color($event)">Add New</button>
              </div>
          </div>
          <div class="form-group col-md-4 ">
               <label >Price</label>
                <input type="number" v-model="price" class="form-control" required  placeholder="Variant Price Here..">
          </div>
      </div>
      <div class="row">
          <div class="col-md-4">
               <label >Variant Quantity</label>
                <input type="number" v-model="quantity"  class="form-control" required  placeholder="Put Product Name Here..">
          </div>
          <div class="col-md-8">
               <label >Variant Image</label>
                <input type="file" ref="file" @change="onChangeFileUpload" class="form-control" required  placeholder="Put Product Image Here..">
          </div>
      </div>
      <button type="submit" class="btn btn-primary form-control m-2">Submit</button>
  </form>
   <div >
                    <div :class="[sizeActive ? 'active' : '', !sizeActive ? 'notActive' : '']" >
                            <div class="card-header">

                            <h6><b>Add a New Size</b></h6>
                            </div>

                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="exampleFormControlInput3">Size Name</label>
                                    <input type="text" required v-model="size_name" class="form-control" id="exampleFormControlInput3" placeholder="Put Size Name Here..">

                                </div>
                                <div class="form-group">
                                    <label >Size Description (Optional)</label>
                                    <textarea   class="form-control" v-model="size_desc" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success m-2" @click="sizeForm($event)">Submit</button>
                                    <button class="btn btn-danger m-2" @click="sizeActive=!sizeActive">Cancel</button>
                                </div>
                            </div>


                    </div>
            </div>
            <div >
                    <div :class="[clrActive ? 'active' : '', !clrActive ? 'notActive' : '']" >
                            <div class="card-header">

                            <h6><b>Add a New Color</b></h6>

                            </div>


                                <div class="card-body">
                                <div class="form-group ">
                                    <label >Color Name</label>
                                    <input type="text" required v-model="clr_name" class="form-control" placeholder="Put Color Name Here..">

                                </div>
                                <div class="form-group">
                                    <label>Color-Code (Optional)</label>
                                   <input type="text" v-model="clr_code" class="form-control" placeholder="Put Color Name Here..">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success m-2" @click="colorForm($event)">Submit</button>
                                    <button class="btn btn-danger m-2" @click="clrActive=!clrActive">Cancel</button>
                                </div>
                            </div>


                    </div>
            </div>
</div>
</template>

<script>
export default {
    props:{
        product:{
            type:Object,
            default:[]
        },
    },
    data: () => ({
      image: null,
      product_id:null,
      size:"",
      color:"",
      price:0,
      quantity:0,
      variants:[],
      clr_name:"",
      clr_code:"",
      size_name:"",
      size_desc:"",
      clrActive:false,
      sizeActive:false,
      sizes:[],
      colors:[],
    }),
    created(){
        // console.log(this.$props)
        this.product_id=this.$props.product.id
        this.fetch_colors();
        this.fetch_sizes();
        this.fetch_variants();
    },
    methods:{
        fetch_colors(){
             axios.get(`/colors`).then((res)=>{
               this.colors=res.data.colors;
            }).catch((err)=>console.log(err))
        },
        fetch_sizes(){
             axios.get(`/sizes`).then((res)=>{
               this.sizes=res.data.sizes;
            }).catch((err)=>console.log(err))
        },
        create_color(e){
            e.preventDefault();
            this.clrActive=!this.clrActive;
        },
        create_size(e){
            e.preventDefault();
            this.sizeActive=!this.sizeActive;
        },
        colorForm(e){
            e.preventDefault();
            let formData = new FormData();
            formData.append('name',this.clr_name);
            formData.append('color_code',this.clr_code);
            axios.post(`/colors`,formData).then((res)=>{
                 this.$alert(
                        res.data.message,
                        "",
                        "success"
                        );
               this.colors.push(res.data.Color);
                this.clrActive=!this.clrActive;
            }).catch((err)=>console.log(err))
        },
        sizeForm(e){
            e.preventDefault();
             let formData = new FormData();

            formData.append('name',this.size_name);
            formData.append('description',this.size_desc);
            axios.post(`/sizes`,formData).then((res)=>{
                 this.$alert(
                        res.data.message,
                        "",
                        "success"
                        );
              this.sizes.push(res.data.Size);
               this.sizeActive=!this.sizeActive;
            }).catch((err)=>console.log(err))
        },
        onChangeFileUpload(e){
        console.log(e.target.files[0])
        this.image =e.target.files[0];
      },
      fetch_variants(){
          axios.get(`/products/${this.product_id}/variants`).then((res)=>{
              console.lpog(res)
          }).catch((err)=>console.log(err))
      },

      variantSubmission(e){
          e.preventDefault();
           let formData = new FormData();
            formData.append('product_id',this.product_id);
            formData.append('size_id',this.size);
            formData.append('color_id',this.color);
            formData.append('variant_price',this.price);
            formData.append('variant_image',this.image);
            formData.append('variant_qty',this.quantity);

            axios.post(`/product_variants`,formData,{ headers: {
                    'Content-Type': 'multipart/form-data'
                }}).then((res)=>{
                     this.$alert(
                        res.data.message,
                        "",
                        "success"
                        );
                    this.variants.push(res.data.variant);
                    this.product_id=null;
                    this.size="";
                    this.color="";
                    this.price=0;
                    this.image="";
                    this.quantity=0;
                }).catch((err)=>console.log(err))
      }

    }


}
</script>

<style lang="scss">
    .active{
        background-color: rgb(240, 245, 247);
        display: block;
        position: absolute;
        top: 20%;
        left: 30%;
        right: 30%;
        z-index: 100;
    }
    .notActive{
        display: none;
    }
</style>>
