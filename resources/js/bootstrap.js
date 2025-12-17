import axios from 'axios';
import * as bootstrap from 'bootstrap';
import $ from 'jquery';
import 'select2/dist/css/select2.min.css';
import select2 from "select2"
import 'select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css';
import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
select2(); 

window.bootstrap = bootstrap;
window.axios = axios;
window.$ = $;
window.jQuery = $;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
