<template>
    <div >
        <div >
            <h1 class="text text-center m-4">Edit Product</h1>
            <form  @submit="productUpdate">
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="exampleFormControlInput1">Product Name</label>
                        <input type="text" v-model="p_name" class="form-control" required id="exampleFormControlInput1" placeholder="Put Product Name Here..">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleFormControlInput1">Brand (Optional)</label>
                        <input type="text" class="form-control" v-model="brand" id="exampleFormControlInput1" placeholder="Put Product Name Here..">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label >Select Category</label>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <select class="form-control" required v-model="category" >
                                <option value="" selected>--Select--</option>
                                <option v-for="(category ,index) in categories" :key="index" :value="category.id">{{category.name}}</option>
                                </select>
                            </div>
                            <button class="btn btn-primary col-md-4 col-sm-4" @click="create_category($event)">Add New</button>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label >Select Sub-ategory</label>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <select class="form-control" v-model="sub_category" required >
                                <option value="" selected>--Select--</option>
                                <option v-for="(sub_cat ,index) in sub_categories" :key="index" :value="sub_cat.id">{{sub_cat.name}}</option>
                                </select>
                            </div>
                            <button class="btn btn-primary col-md-4 col-sm-4"  @click="create_subcategory($event)">Add New</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Product Description</label>
                    <textarea class="form-control" v-model="p_description" required id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button class="btn btn-primary form-control" type="submit">Update</button>
            </form>
            <div >
                    <div :class="[catActive ? 'active' : '', !catActive ? 'notActive' : '']" >
                            <div class="card-header">

                            <h6><b>Add a New Category</b></h6>
                            <p v-if="errors.length">
                                <b>Please correct the following error(s):</b>
                                <ul>
                                <li v-for="(error,index) in errors" :key="index">{{ error }}</li>
                                </ul>
                            </p>
                            </div>
                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="exampleFormControlInput3">Category Name</label>
                                    <input type="text" v-model="newcat" name="catname" class="form-control" id="exampleFormControlInput3" placeholder="Put Category Name Here..">
                                    <p class="text text-sm text-danger"> </p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea4">Category Description (Optional)</label>
                                    <textarea v-model="catdesc" name="catdesc" class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success m-2" @click="categoryForm()">Submit</button>
                                    <button class="btn btn-danger m-2" @click="catActive=!catActive">Cancel</button>
                                </div>
                            </div>

                    </div>
            </div>
            <div >
                    <div :class="[subcatActive ? 'active' : '', !subcatActive ? 'notActive' : '']" >
                            <div class="card-header">

                            <h6><b>Add a New Sub-Category</b></h6>
                            <p v-if="errors.length">
                                <b>Please correct the following error(s):</b>
                                <ul>
                                <li v-for="(error,index) in errors" :key="index">{{ error }}</li>
                                </ul>
                            </p>
                            </div>

                            <div class="card-body">
                                <div class="form-group ">
                                    <label for="exampleFormControlSelect4">Select Category</label>
                                    <select class="form-control" v-model="scategory" id="exampleFormControlSelect4">
                                    <option value="" selected>--Select--</option>
                                    <option v-for="(category ,index) in categories" :key="index" :value="category.id">{{category.name}}</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput3">Category Name</label>
                                    <input type="text" v-model="newsubcat" name="catname" class="form-control" id="exampleFormControlInput3" placeholder="Put Category Name Here..">
                                    <p class="text text-sm text-danger"> </p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea4">Category Description (Optional)</label>
                                    <textarea v-model="subcat_desc" name="catdesc" class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success m-2" @click="subcategoryForm()">Submit</button>
                                    <button class="btn btn-danger m-2" @click="subcatActive=!subcatActive">Cancel</button>
                                </div>
                            </div>

                    </div>
            </div>
        </div><hr>





    </div>

</template>

<script>
import CreateVariant from './CreateVariant.vue';
import EditVariant from './EditVariant.vue';
export default {
  components: { CreateVariant, EditVariant },
  props:{
        selected_product:{
            type:Object,
            default:[]
        },
    },
    data: () => ({
        product_id:null,
       s_product:null,
       categories:[],
       sub_categories:[],
       category:"",
       newcat:null,
       catdesc:"",
       sub_category:"",
       newsubcat:null,
       subcat_desc:"",
       p_name:"",
       p_description:"",
       brand:"",
       catActive:false,
       subcatActive:false,
       scategory:"",
       errors:[]

    }),
    watch:{
        category: function (val) {
            this.get_subCategories(val);
        },
    },
    created(){

    },
    mounted(){
        this.get_categories();
        this.s_product=this.$props.selected_product;
        this.p_name=this.s_product.product_name;
        this.p_description=this.s_product.product_description;
        this.category=this.s_product.category_id;
        this.sub_category=this.s_product.sub_category_id;
        this.brand=this.s_product.product_brand;
        this.product_id=this.s_product.id;
    },
    methods:{
        productUpdate(e){
            e.preventDefault();

            axios.put(`/products/${this.s_product.id}`,{
                'product_name':this.p_name,
                'product_description':this.p_description,
                'product_brand':this.brand,
                'category_id':this.category,
                'sub_category_id':this.sub_category
            },{}).then((res)=>{
                this.product=res.data.product
            }).then((err)=>console.log(err))

        },
        get_categories(){
            axios.get(`/categories`).then((res)=>{
                this.categories=res.data.categories;
            }).catch((err)=>console.log(err))
        },
        create_category(e){
            e.preventDefault();
            this.catActive=!this.catActive;


        },
        create_subcategory(e){
            e.preventDefault();
            this.subcatActive=!this.subcatActive;


        },
        get_subCategories(val){
            axios.get(`/fetchsubcat/${val}`).then((res)=>{
                this.sub_categories=res.data.subcats;
            }).catch((err)=>console.log(err))
        },

        categoryForm(){
            let formData = new FormData();
            formData.append('name',this.newcat);
            formData.append('description',this.catdesc);
            axios.post(`/categories`,formData).then((res)=>{
                        this.categories.push(res.data.category);
                        this.catActive=false;
                    }).catch((err)=>{
                        console.log(err)
                        this.errors.push("Please Fill Required fields")
                        })
            },
        subcategoryForm(){
            let formData = new FormData();
            formData.append('name',this.newsubcat);
            formData.append('description',this.subcat_desc);
            formData.append('category_id',this.scategory);
            axios.post(`/subcategories`,formData).then((res)=>{
                        this.sub_categories.push(res.data.sub_category);
                        this.subcatActive=false;
                    }).catch((err)=>{
                        console.log(err)
                        this.errors.push("Please Fill Required fields")
                        })
            },

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

</style>
