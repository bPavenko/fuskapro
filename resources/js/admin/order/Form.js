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
                categories: [],
                city_name: '',
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
                this.form.categories = response.data;
            }.bind(this));
        },
        autoComplete(){
            this.cities = [];
            if(this.form.city_name.length > 1){
                axios.get('/admin/orders/get-cities',{params: {query: this.form.city_name}}).then(response => {
                    this.cities = response.data;
                });
            }
        },
        setCity($id, $name) {
            this.cities = [];
            this.form.city_name = $name;
            this.form.city = $id;
        }
    }

});