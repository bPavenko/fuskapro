import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                section_id:  '' ,
                category_id:  '' ,
                short_description:  '' ,
                full_description:  '' ,
                execution_date:  '' ,
                start_execution_time:  '' ,
                end_execution_time:  '' ,
                price:  '' ,
                by_user:  '' ,
                city: '',
                price_negotiable:  false ,
            },
            categories: [],
            query: '',
            cities: []
        }
    },
    methods:{
        getCategories(section_id) {
            axios.get('/admin/orders/get-categories', {
                params: {
                    section_id: section_id
                }
            }).then(function (response){
                console.log(response.data)
                this.categories = response.data;
            }.bind(this));
        },
        getCity(section_id) {
            axios.get('/admin/orders/get-categories', {
                params: {
                    section_id: section_id
                }
            }).then(function (response){
                console.log(response.data)
                this.categories = response.data;
            }.bind(this));
        },
        autoComplete(){
            this.cities = [];
            if(this.query.length > 2){
                axios.get('/admin/orders/get-cities',{params: {query: this.query}}).then(response => {
                    this.cities = response.data;
                });
            }
        },
        setCity($id, $name) {
            this.cities = [];
            this.query = $name;
            this.form.city = $id;
        }
    }

});