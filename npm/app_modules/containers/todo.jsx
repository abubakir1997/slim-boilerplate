import React from 'react';
import tasks from 'reducers/todo';
import App 	 from 'components/todo/App';
import { render } 		from 'react-dom';
import { createStore } 	from 'redux';
import { Provider } 	from 'react-redux';

const store = createStore(
    tasks,
    [
	    {"id": "01", "executor": "Jason", "text": "Buy milk", "status": "TODO"},
	    {"id": "02", "executor": "Sam", "text": "Meeting with a client", "status": "TODO"},
	    {"id": "03", "executor": "Kate", "text": "Create new project", "status": "TODO"},
	    {"id": "04", "executor": "All", "text": "Update site", "status": "DOING"},
	    {"id": "05", "executor": "Sam", "text": "Write new posts", "status": "DONE"},
	    {"id": "06", "executor": "Jason", "text": "Fix my phone", "status": "DONE"}
	]
);

render(
    <Provider store={store}>
        <App />
    </Provider>,
    document.getElementById('react-app')
);