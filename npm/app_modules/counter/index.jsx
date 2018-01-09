import React   from 'react'
import Counter from 'counter/containers'
import Reducer from 'counter/reducers'
import Thunk   from 'redux-thunk'
import Multi   from 'redux-multi'

import { render }   from 'react-dom'
import { Provider } from 'react-redux'

import {
	createStore,
	applyMiddleware
} from 'redux'

let store = createStore(Reducer.handler, Reducer.initState, applyMiddleware(Thunk, Multi))

render(
	<Provider store={store}>
		<Counter />
	</Provider>
, document.getElementById('app-root'))