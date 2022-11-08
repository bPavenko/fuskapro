import AppForm from '../app-components/Form/AppForm';

Vue.component('footer-title-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});