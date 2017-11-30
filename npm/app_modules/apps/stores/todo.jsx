import React           from 'react'
import { render }      from 'react-dom'
import { Provider }    from 'react-redux'
import { createStore } from 'redux'
import reducer         from 'apps/reducers/todo'
import App             from 'apps/components/todo/app'

let store = createStore(reducer)

render(
  <Provider store={store}>
    <App />
  </Provider>,
  document.getElementById('react-todo')
)