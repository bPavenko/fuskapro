import AppForm from '../app-components/Form/AppForm';

Vue.component('price-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                service:  '' ,
                cost:  '' ,
                
            }
        }
    }

});