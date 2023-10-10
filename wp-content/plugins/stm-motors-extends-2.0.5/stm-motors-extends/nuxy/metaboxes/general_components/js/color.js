(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

Vue.component('wpcfto_color', {
  props: ['fields', 'field_label', 'field_name', 'field_id', 'field_value'],
  components: {
    'slider-picker': VueColor.Chrome
  },
  data: function data() {
    return {
      input_value: '',
      position: 'bottom',
      value: {
        r: 255,
        g: 255,
        b: 255,
        a: 1
      }
    };
  },
  created: function created() {
    if (typeof this.field_value === 'string') {
      this.input_value = this.field_value;
      var colors = this.field_value.replace('rgba(', '').slice(0, -1).split(',');
      this.$set(this.value, 'r', colors[0]);
      this.$set(this.value, 'g', colors[1]);
      this.$set(this.value, 'b', colors[2]);
      this.$set(this.value, 'a', colors[3]);
    }

    if (this.fields.position) this.position = this.fields.position;
  },
  template: "\n        <div class=\"wpcfto_generic_field wpcfto_generic_field_color\">\n        \n            <wpcfto_fields_aside_before :fields=\"fields\" :field_label=\"field_label\"></wpcfto_fields_aside_before>\n            \n            <div class=\"wpcfto-field-content\">\n                        \n                <div class=\"stm_colorpicker_wrapper\" v-bind:class=\"['picker-position-' + position]\">\n\n                    <span v-bind:style=\"{'background-color': input_value}\" @click=\"$refs.field_name.focus()\"></span>\n    \n                    <input type=\"text\"\n                           v-bind:name=\"field_name\"\n                           v-bind:placeholder=\"field_label\"\n                           v-bind:id=\"field_id\"\n                           v-model=\"input_value\"\n                           ref=\"field_name\"\n                    />\n    \n                    <div>\n                        <slider-picker v-model=\"value\"></slider-picker>\n                    </div>\n\n                      <a href=\"#\" @click.prevent=\"input_value=''\" v-if=\"input_value\" class=\"wpcfto_generic_field_color__clear\">\n                        <i class=\"fa fa-times\"></i>\n                      </a>\n    \n                </div>\n            \n            </div>\n            \n            <wpcfto_fields_aside_after :fields=\"fields\"></wpcfto_fields_aside_after>\n            \n        </div>\n    ",
  methods: {},
  watch: {
    input_value: function input_value(value) {
      this.$emit('wpcfto-get-value', value);
    },
    value: function value(_value) {
      if (typeof _value.rgba !== 'undefined') {
        var rgba_color = 'rgba(' + _value.rgba.r + ',' + _value.rgba.g + ',' + _value.rgba.b + ',' + _value.rgba.a + ')';
        this.$set(this, 'input_value', rgba_color);
        this.$emit('wpcfto-get-value', rgba_color);
      }
    }
  }
});
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyJWdWUiLCJjb21wb25lbnQiLCJwcm9wcyIsImNvbXBvbmVudHMiLCJWdWVDb2xvciIsIkNocm9tZSIsImRhdGEiLCJpbnB1dF92YWx1ZSIsInBvc2l0aW9uIiwidmFsdWUiLCJyIiwiZyIsImIiLCJhIiwiY3JlYXRlZCIsImZpZWxkX3ZhbHVlIiwiY29sb3JzIiwicmVwbGFjZSIsInNsaWNlIiwic3BsaXQiLCIkc2V0IiwiZmllbGRzIiwidGVtcGxhdGUiLCJtZXRob2RzIiwid2F0Y2giLCIkZW1pdCIsIl92YWx1ZSIsInJnYmEiLCJyZ2JhX2NvbG9yIl0sInNvdXJjZXMiOlsiZmFrZV9iYWExMzRhZi5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcblxuVnVlLmNvbXBvbmVudCgnd3BjZnRvX2NvbG9yJywge1xuICBwcm9wczogWydmaWVsZHMnLCAnZmllbGRfbGFiZWwnLCAnZmllbGRfbmFtZScsICdmaWVsZF9pZCcsICdmaWVsZF92YWx1ZSddLFxuICBjb21wb25lbnRzOiB7XG4gICAgJ3NsaWRlci1waWNrZXInOiBWdWVDb2xvci5DaHJvbWVcbiAgfSxcbiAgZGF0YTogZnVuY3Rpb24gZGF0YSgpIHtcbiAgICByZXR1cm4ge1xuICAgICAgaW5wdXRfdmFsdWU6ICcnLFxuICAgICAgcG9zaXRpb246ICdib3R0b20nLFxuICAgICAgdmFsdWU6IHtcbiAgICAgICAgcjogMjU1LFxuICAgICAgICBnOiAyNTUsXG4gICAgICAgIGI6IDI1NSxcbiAgICAgICAgYTogMVxuICAgICAgfVxuICAgIH07XG4gIH0sXG4gIGNyZWF0ZWQ6IGZ1bmN0aW9uIGNyZWF0ZWQoKSB7XG4gICAgaWYgKHR5cGVvZiB0aGlzLmZpZWxkX3ZhbHVlID09PSAnc3RyaW5nJykge1xuICAgICAgdGhpcy5pbnB1dF92YWx1ZSA9IHRoaXMuZmllbGRfdmFsdWU7XG4gICAgICB2YXIgY29sb3JzID0gdGhpcy5maWVsZF92YWx1ZS5yZXBsYWNlKCdyZ2JhKCcsICcnKS5zbGljZSgwLCAtMSkuc3BsaXQoJywnKTtcbiAgICAgIHRoaXMuJHNldCh0aGlzLnZhbHVlLCAncicsIGNvbG9yc1swXSk7XG4gICAgICB0aGlzLiRzZXQodGhpcy52YWx1ZSwgJ2cnLCBjb2xvcnNbMV0pO1xuICAgICAgdGhpcy4kc2V0KHRoaXMudmFsdWUsICdiJywgY29sb3JzWzJdKTtcbiAgICAgIHRoaXMuJHNldCh0aGlzLnZhbHVlLCAnYScsIGNvbG9yc1szXSk7XG4gICAgfVxuXG4gICAgaWYgKHRoaXMuZmllbGRzLnBvc2l0aW9uKSB0aGlzLnBvc2l0aW9uID0gdGhpcy5maWVsZHMucG9zaXRpb247XG4gIH0sXG4gIHRlbXBsYXRlOiBcIlxcbiAgICAgICAgPGRpdiBjbGFzcz1cXFwid3BjZnRvX2dlbmVyaWNfZmllbGQgd3BjZnRvX2dlbmVyaWNfZmllbGRfY29sb3JcXFwiPlxcbiAgICAgICAgXFxuICAgICAgICAgICAgPHdwY2Z0b19maWVsZHNfYXNpZGVfYmVmb3JlIDpmaWVsZHM9XFxcImZpZWxkc1xcXCIgOmZpZWxkX2xhYmVsPVxcXCJmaWVsZF9sYWJlbFxcXCI+PC93cGNmdG9fZmllbGRzX2FzaWRlX2JlZm9yZT5cXG4gICAgICAgICAgICBcXG4gICAgICAgICAgICA8ZGl2IGNsYXNzPVxcXCJ3cGNmdG8tZmllbGQtY29udGVudFxcXCI+XFxuICAgICAgICAgICAgICAgICAgICAgICAgXFxuICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9XFxcInN0bV9jb2xvcnBpY2tlcl93cmFwcGVyXFxcIiB2LWJpbmQ6Y2xhc3M9XFxcIlsncGlja2VyLXBvc2l0aW9uLScgKyBwb3NpdGlvbl1cXFwiPlxcblxcbiAgICAgICAgICAgICAgICAgICAgPHNwYW4gdi1iaW5kOnN0eWxlPVxcXCJ7J2JhY2tncm91bmQtY29sb3InOiBpbnB1dF92YWx1ZX1cXFwiIEBjbGljaz1cXFwiJHJlZnMuZmllbGRfbmFtZS5mb2N1cygpXFxcIj48L3NwYW4+XFxuICAgIFxcbiAgICAgICAgICAgICAgICAgICAgPGlucHV0IHR5cGU9XFxcInRleHRcXFwiXFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgdi1iaW5kOm5hbWU9XFxcImZpZWxkX25hbWVcXFwiXFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgdi1iaW5kOnBsYWNlaG9sZGVyPVxcXCJmaWVsZF9sYWJlbFxcXCJcXG4gICAgICAgICAgICAgICAgICAgICAgICAgICB2LWJpbmQ6aWQ9XFxcImZpZWxkX2lkXFxcIlxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgIHYtbW9kZWw9XFxcImlucHV0X3ZhbHVlXFxcIlxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgIHJlZj1cXFwiZmllbGRfbmFtZVxcXCJcXG4gICAgICAgICAgICAgICAgICAgIC8+XFxuICAgIFxcbiAgICAgICAgICAgICAgICAgICAgPGRpdj5cXG4gICAgICAgICAgICAgICAgICAgICAgICA8c2xpZGVyLXBpY2tlciB2LW1vZGVsPVxcXCJ2YWx1ZVxcXCI+PC9zbGlkZXItcGlja2VyPlxcbiAgICAgICAgICAgICAgICAgICAgPC9kaXY+XFxuXFxuICAgICAgICAgICAgICAgICAgICAgIDxhIGhyZWY9XFxcIiNcXFwiIEBjbGljay5wcmV2ZW50PVxcXCJpbnB1dF92YWx1ZT0nJ1xcXCIgdi1pZj1cXFwiaW5wdXRfdmFsdWVcXFwiIGNsYXNzPVxcXCJ3cGNmdG9fZ2VuZXJpY19maWVsZF9jb2xvcl9fY2xlYXJcXFwiPlxcbiAgICAgICAgICAgICAgICAgICAgICAgIDxpIGNsYXNzPVxcXCJmYSBmYS10aW1lc1xcXCI+PC9pPlxcbiAgICAgICAgICAgICAgICAgICAgICA8L2E+XFxuICAgIFxcbiAgICAgICAgICAgICAgICA8L2Rpdj5cXG4gICAgICAgICAgICBcXG4gICAgICAgICAgICA8L2Rpdj5cXG4gICAgICAgICAgICBcXG4gICAgICAgICAgICA8d3BjZnRvX2ZpZWxkc19hc2lkZV9hZnRlciA6ZmllbGRzPVxcXCJmaWVsZHNcXFwiPjwvd3BjZnRvX2ZpZWxkc19hc2lkZV9hZnRlcj5cXG4gICAgICAgICAgICBcXG4gICAgICAgIDwvZGl2PlxcbiAgICBcIixcbiAgbWV0aG9kczoge30sXG4gIHdhdGNoOiB7XG4gICAgaW5wdXRfdmFsdWU6IGZ1bmN0aW9uIGlucHV0X3ZhbHVlKHZhbHVlKSB7XG4gICAgICB0aGlzLiRlbWl0KCd3cGNmdG8tZ2V0LXZhbHVlJywgdmFsdWUpO1xuICAgIH0sXG4gICAgdmFsdWU6IGZ1bmN0aW9uIHZhbHVlKF92YWx1ZSkge1xuICAgICAgaWYgKHR5cGVvZiBfdmFsdWUucmdiYSAhPT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgdmFyIHJnYmFfY29sb3IgPSAncmdiYSgnICsgX3ZhbHVlLnJnYmEuciArICcsJyArIF92YWx1ZS5yZ2JhLmcgKyAnLCcgKyBfdmFsdWUucmdiYS5iICsgJywnICsgX3ZhbHVlLnJnYmEuYSArICcpJztcbiAgICAgICAgdGhpcy4kc2V0KHRoaXMsICdpbnB1dF92YWx1ZScsIHJnYmFfY29sb3IpO1xuICAgICAgICB0aGlzLiRlbWl0KCd3cGNmdG8tZ2V0LXZhbHVlJywgcmdiYV9jb2xvcik7XG4gICAgICB9XG4gICAgfVxuICB9XG59KTsiXSwibWFwcGluZ3MiOiJBQUFBOztBQUVBQSxHQUFHLENBQUNDLFNBQUosQ0FBYyxjQUFkLEVBQThCO0VBQzVCQyxLQUFLLEVBQUUsQ0FBQyxRQUFELEVBQVcsYUFBWCxFQUEwQixZQUExQixFQUF3QyxVQUF4QyxFQUFvRCxhQUFwRCxDQURxQjtFQUU1QkMsVUFBVSxFQUFFO0lBQ1YsaUJBQWlCQyxRQUFRLENBQUNDO0VBRGhCLENBRmdCO0VBSzVCQyxJQUFJLEVBQUUsU0FBU0EsSUFBVCxHQUFnQjtJQUNwQixPQUFPO01BQ0xDLFdBQVcsRUFBRSxFQURSO01BRUxDLFFBQVEsRUFBRSxRQUZMO01BR0xDLEtBQUssRUFBRTtRQUNMQyxDQUFDLEVBQUUsR0FERTtRQUVMQyxDQUFDLEVBQUUsR0FGRTtRQUdMQyxDQUFDLEVBQUUsR0FIRTtRQUlMQyxDQUFDLEVBQUU7TUFKRTtJQUhGLENBQVA7RUFVRCxDQWhCMkI7RUFpQjVCQyxPQUFPLEVBQUUsU0FBU0EsT0FBVCxHQUFtQjtJQUMxQixJQUFJLE9BQU8sS0FBS0MsV0FBWixLQUE0QixRQUFoQyxFQUEwQztNQUN4QyxLQUFLUixXQUFMLEdBQW1CLEtBQUtRLFdBQXhCO01BQ0EsSUFBSUMsTUFBTSxHQUFHLEtBQUtELFdBQUwsQ0FBaUJFLE9BQWpCLENBQXlCLE9BQXpCLEVBQWtDLEVBQWxDLEVBQXNDQyxLQUF0QyxDQUE0QyxDQUE1QyxFQUErQyxDQUFDLENBQWhELEVBQW1EQyxLQUFuRCxDQUF5RCxHQUF6RCxDQUFiO01BQ0EsS0FBS0MsSUFBTCxDQUFVLEtBQUtYLEtBQWYsRUFBc0IsR0FBdEIsRUFBMkJPLE1BQU0sQ0FBQyxDQUFELENBQWpDO01BQ0EsS0FBS0ksSUFBTCxDQUFVLEtBQUtYLEtBQWYsRUFBc0IsR0FBdEIsRUFBMkJPLE1BQU0sQ0FBQyxDQUFELENBQWpDO01BQ0EsS0FBS0ksSUFBTCxDQUFVLEtBQUtYLEtBQWYsRUFBc0IsR0FBdEIsRUFBMkJPLE1BQU0sQ0FBQyxDQUFELENBQWpDO01BQ0EsS0FBS0ksSUFBTCxDQUFVLEtBQUtYLEtBQWYsRUFBc0IsR0FBdEIsRUFBMkJPLE1BQU0sQ0FBQyxDQUFELENBQWpDO0lBQ0Q7O0lBRUQsSUFBSSxLQUFLSyxNQUFMLENBQVliLFFBQWhCLEVBQTBCLEtBQUtBLFFBQUwsR0FBZ0IsS0FBS2EsTUFBTCxDQUFZYixRQUE1QjtFQUMzQixDQTVCMkI7RUE2QjVCYyxRQUFRLEVBQUUsZzVDQTdCa0I7RUE4QjVCQyxPQUFPLEVBQUUsRUE5Qm1CO0VBK0I1QkMsS0FBSyxFQUFFO0lBQ0xqQixXQUFXLEVBQUUsU0FBU0EsV0FBVCxDQUFxQkUsS0FBckIsRUFBNEI7TUFDdkMsS0FBS2dCLEtBQUwsQ0FBVyxrQkFBWCxFQUErQmhCLEtBQS9CO0lBQ0QsQ0FISTtJQUlMQSxLQUFLLEVBQUUsU0FBU0EsS0FBVCxDQUFlaUIsTUFBZixFQUF1QjtNQUM1QixJQUFJLE9BQU9BLE1BQU0sQ0FBQ0MsSUFBZCxLQUF1QixXQUEzQixFQUF3QztRQUN0QyxJQUFJQyxVQUFVLEdBQUcsVUFBVUYsTUFBTSxDQUFDQyxJQUFQLENBQVlqQixDQUF0QixHQUEwQixHQUExQixHQUFnQ2dCLE1BQU0sQ0FBQ0MsSUFBUCxDQUFZaEIsQ0FBNUMsR0FBZ0QsR0FBaEQsR0FBc0RlLE1BQU0sQ0FBQ0MsSUFBUCxDQUFZZixDQUFsRSxHQUFzRSxHQUF0RSxHQUE0RWMsTUFBTSxDQUFDQyxJQUFQLENBQVlkLENBQXhGLEdBQTRGLEdBQTdHO1FBQ0EsS0FBS08sSUFBTCxDQUFVLElBQVYsRUFBZ0IsYUFBaEIsRUFBK0JRLFVBQS9CO1FBQ0EsS0FBS0gsS0FBTCxDQUFXLGtCQUFYLEVBQStCRyxVQUEvQjtNQUNEO0lBQ0Y7RUFWSTtBQS9CcUIsQ0FBOUIifQ==
},{}]},{},[1])