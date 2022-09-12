import AppForm from '../app-components/Form/AppForm';

Vue.component('task-category-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                parent_id:  '' ,
                
            }
        }
    }

});