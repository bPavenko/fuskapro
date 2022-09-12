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
                price_negotiable:  false ,
                
            }
        }
    }

});