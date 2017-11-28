import ajax  from 'services/ajax';
import 'containers/todo';

console.log('React App: from Dashboard!');

ajax
	.post('/jwt')
	.then(function(res) {
		console.log('JWT Request: from dashboard', res.data);
	})
;
