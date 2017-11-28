import ajax  from 'services/ajax';
import 'containers/todo';

console.log('React App: from Dashboard!');

ajax
	.post('/test')
	.then(function(res) {
		console.log('Ajax Request: from dashboard', res.data);
	})
;

