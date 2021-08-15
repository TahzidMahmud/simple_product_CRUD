<template>
<div>
  <h3>Product Variants</h3>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Size</th>
        <th scope="col">Color</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
        </tr>
    </tbody>
    </table>

</div>
</template>

<script>
export default {
     props:{
        p_id:null
    },
    data: () => ({
        product_id:null

    }),
    created(){
        this.product_id=this.$props.p_id
        this.fetch_variants();
    },
    methods:{
        fetch_variants(){
            axios.get(`/products/${this.product_id}/variants`).then((res)=>{
                console.log(res);
            }).catch((err)=>console.log(err))
        }
    }
}
</script>

<style>

</style>
