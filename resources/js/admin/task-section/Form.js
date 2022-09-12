import AppForm from '../app-components/Form/AppForm';

Vue.component('task-section-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});