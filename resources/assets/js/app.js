var App = {
    scripts: [],

    require: function(script) { this.scripts.push(script); }
};

/*
 * App Scripts
 */
App.require('app/jquery.js');
App.require('app/bootstrap.js');
App.require('app/theme.js');
App.require('app/script.js');
App.require('app/datatables.js');
App.require('app/dropzone.js');
App.require('app/cropper.js');
App.require('app/chart.js');
App.require('app/vue.js');
App.require('app/http.js');
App.require('app/datepicker.js');
App.require('app/helpers.js');

/*
 * App Components
 */
App.require('components/main.js');
App.require('components/orphans.js');
App.require('components/orphan.js');
App.require('components/donors.js');
App.require('components/donor.js');
App.require('components/users.js');
App.require('components/user.js');
App.require('components/profile.js');
App.require('components/donorOrphans.js');
App.require('components/donorOrphansList.js');
App.require('components/dialog.js');
App.require('components/gallery.js');
App.require('components/email.js');
App.require('components/loading.js');
App.require('components/videoplayer.js');
App.require('components/dashboard.js');


module.exports = App;