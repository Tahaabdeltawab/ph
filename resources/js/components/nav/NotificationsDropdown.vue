<template>
  <li class="nav-item dropdown">
    <a
      href="#"
      class="nav-link dropdown-toggle"
      data-bs-toggle="dropdown"
      role="button"
      aria-haspopup="true"
      aria-expanded="false"
    >
     <b-icon icon="bell-fill" class="notification-bell"></b-icon>
      <span class="btn__badge pulse-button">{{notifications.length}}</span>
    </a>
    <ul class="dropdown-menu notify-drop">
      <div class="notify-drop-title">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6">{{$t('Notifications')}}</div>
        </div>
      </div>
      <div class="drop-content">
        <li v-for="notification in notifications" :key="notification.id" class="row">
          <div class="col-md-3 col-sm-3 col-xs-3 notify-img-section">
            <div class="notify-img">
              <img v-if="notification.image" :src="notification.image" alt="" />
            </div>
          </div>
          <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
            <a href="#">{{notification.title_ar}}</a>
            <p>{{notification.body_ar}}</p>
            <!-- <p class="time">2 mins ago</p> -->
          </div>
        </li>
      </div>
      <div class="notify-drop-footer text-center">
        <a href="#"><i class="fa fa-eye"></i> {{$t('See all')}}</a>
      </div>
    </ul>
  </li>
</template>

<script>
import { mapGetters } from "vuex";
import { loadMessages } from "~/plugins/i18n";

export default {
  computed: mapGetters({
    notifications: 'auth/notifications'
  }),
   created() {
     this.fetchNotifications()
    },
  methods: {
    async fetchNotifications(){
      await this.$store.dispatch('auth/fetchNotifications')
    }
  },
};
</script>
<style scoped>
li,
a {
  text-align: right;
}

.drop-content {
  overflow-x: hidden;
}
.dropdown-menu.notify-drop {
  min-width: 330px;
  background-color: #fff;
  min-height: 360px;
  max-height: 360px;
}
.dropdown-menu.notify-drop .notify-drop-title {
  border-bottom: 1px solid #e2e2e2;
  padding: 5px 15px 10px 15px;
}
.dropdown-menu.notify-drop .drop-content {
  min-height: 280px;
  max-height: 280px;
  overflow-y: scroll;
}
.dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-track {
  background-color: #f5f5f5;
}

.dropdown-menu.notify-drop .drop-content::-webkit-scrollbar {
  width: 8px;
  background-color: #f5f5f5;
}

.dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-thumb {
  background-color: #ccc;
}
.dropdown-menu.notify-drop .drop-content > li {
  border-bottom: 1px solid #e2e2e2;
  padding: 10px 0px 5px 0px;
}
.dropdown-menu.notify-drop .drop-content > li:nth-child(2n + 0) {
  background-color: #fafafa;
}
.dropdown-menu.notify-drop .drop-content > li:after {
  content: "";
  clear: both;
  display: block;
}
.dropdown-menu.notify-drop .drop-content > li:hover {
  background-color: #fcfcfc;
}
.dropdown-menu.notify-drop .drop-content > li:last-child {
  border-bottom: none;
}
.dropdown-menu.notify-drop .drop-content > li .notify-img {
  display: inline-block;
  width: 45px;
  height: 45px;
  margin: 0px 0px 8px 0px;
}
.dropdown-menu.notify-drop .drop-content .notify-img-section {
  padding-right: 30px;
}
.dropdown-menu.notify-drop .allRead {
  margin-right: 7px;
}
.dropdown-menu.notify-drop .drop-content > li a {
  font-size: 12px;
  font-weight: normal;
}
.dropdown-menu.notify-drop .drop-content > li {
  font-weight: bold;
  font-size: 11px;
}
.dropdown-menu.notify-drop .drop-content > li hr {
  margin: 5px 0;
  width: 70%;
  border-color: #e2e2e2;
}
.dropdown-menu.notify-drop .drop-content .pd-l0 {
  padding-left: 0;
}
.dropdown-menu.notify-drop .drop-content > li p {
  font-size: 11px;
  color: #666;
  font-weight: normal;
  margin: 3px 0;
}
.dropdown-menu.notify-drop .drop-content > li p.time {
  font-size: 10px;
  font-weight: 600;
  top: -6px;
  margin: 8px 0px 0px 0px;
  padding: 0px 3px;
  border: 1px solid #e2e2e2;
  position: relative;
  background-image: linear-gradient(#fff, #f2f2f2);
  display: inline-block;
  border-radius: 2px;
  color: #b97745;
}
.dropdown-menu.notify-drop .drop-content > li p.time:hover {
  background-image: linear-gradient(#fff, #fff);
}
.dropdown-menu.notify-drop .notify-drop-footer {
  border-top: 1px solid #e2e2e2;
  bottom: 0;
  position: relative;
  padding: 8px 15px;
}
.dropdown-menu.notify-drop .notify-drop-footer a {
  color: #777;
  text-decoration: none;
}
.dropdown-menu.notify-drop .notify-drop-footer a:hover {
  color: #333;
}

ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.notification-drop {
  font-family: "Ubuntu", sans-serif;
  color: #444;
}
.notification-drop .item {
  padding: 10px;
  font-size: 18px;
  position: relative;
  border-bottom: 1px solid #ddd;
}
.notification-drop .item:hover {
  cursor: pointer;
}
.notification-drop .item i {
  margin-left: 10px;
}
.notification-drop .item ul {
  display: none;
  position: absolute;
  top: 100%;
  background: #fff;
  left: -200px;
  right: 0;
  z-index: 1;
  border-top: 1px solid #ddd;
}
.notification-drop .item ul li {
  font-size: 16px;
  padding: 15px 0 15px 25px;
}
.notification-drop .item ul li:hover {
  background: #ddd;
  color: rgba(0, 0, 0, 0.8);
}

@media screen and (min-width: 500px) {
  .notification-drop {
    display: flex;
    justify-content: flex-end;
  }
  .notification-drop .item {
    border: none;
  }
}

.notification-bell {
  font-size: 20px;
}

.btn__badge {
  background: #ff5d5d;
  color: white;
  font-size: 10px;
  position: absolute;
  top: 0;
  right: 0px;
  padding: 0px 6px;
  border-radius: 50%;
}

.pulse-button {
  box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.5);
  -webkit-animation: pulse 1.5s infinite;
}

.pulse-button:hover {
  -webkit-animation: none;
}

@-webkit-keyframes pulse {
  0% {
    -moz-transform: scale(0.9);
    -ms-transform: scale(0.9);
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
  70% {
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
    box-shadow: 0 0 0 50px rgba(255, 0, 0, 0);
  }
  100% {
    -moz-transform: scale(0.9);
    -ms-transform: scale(0.9);
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
    box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
  }
}

.notification-text {
  font-size: 14px;
  font-weight: bold;
}

.notification-text span {
  float: right;
}
</style>