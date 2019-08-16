var vm = new Vue({
        el: '#app',
        data: {
            date: '',
            acc: '',
            loads: '',
            view: 'home',
            loaded: false,
            loadedContent: false,
            title: '',
            activeStation: '',
            trReadings: '',
            fdrReadings: '',
            feeders: '',
            transformers: '',
            lines: '',
            lReadings: '',
            profiles: '',
        },
        created: function () {
            this.fetchData();
        },
        methods: {
            fetchData: function() {
                var url = APP_URL+'acc/index_data';
                var self = this;
                axios.get(url)
                .then(function (res) {
                    var data = res.data;
                    console.log(data.data.loads);
                    data = data.data;
                    self.date = data.date;
                    self.acc  = data.acc;
                    self.loads = data.loads;
                    self.loaded = true;
                });
            },
            fetchStation: function(val) {
                var url = APP_URL+'acc/station/'+val.id;
                var self = this;
                axios.get(url)
                .then(function (res) {
                    self.title = val.name;
                    self.activeStation = val;
                    var data = res.data;
                    console.log(data.data.trReadings);
                    data = data.data;
                    self.transformers  = data.transformers;
                    self.trReadings = data.trReadings;
                    self.feeders  = data.feeders;
                    self.fdrReadings = data.fdrReadings;
                    self.loadedContent = true;
                });
            },
            fetchLines: function() {
                var url = APP_URL+'acc/lines/'+this.acc.id;
                var self = this;
                axios.get(url)
                .then(function (res) {
                    var data = res.data;
                    console.log(data.data.readings);
                    data = data.data;
                    self.lines  = data.lines;
                    self.lReadings = data.readings;
                    self.loadedContent = true;
                });
            },
            fetchProfiles: function() {
                var url = APP_URL+'acc/profiles/'+this.acc.id;
                var self = this;
                axios.get(url)
                .then(function (res) {
                    var data = res.data;
                    console.log(data.data.profiles);
                    data = data.data;
                    self.profiles  = data.profiles;
                });
            },
            isShowing: function(view) {
                return view == this.view;
            },
            goTo: function(view, val) {
                this.view = view;
                switch(view) {
                    case 'station' :
                      this.loadedContent = false;
                        this.fetchStation(val);
                        break;
                    case 'lines' :
                        this.loadedContent = false;
                        this.fetchLines();
                        this.title = '330KV LINES';
                        break;
                    case 'profile' :
                        this.fetchProfiles();
                        this.title = 'LOAD PROFILE';
                        break;
                }
            }
        }
    })
