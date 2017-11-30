import React          from 'react'
import Add            from 'apps/containers/todo/add'
import VisibilityList from 'apps/containers/todo/visibilityList'
import { 
	Segment,
	Header,
	Divider
} from 'semantic-ui-react'

const App = () => (
  <Segment textAlign='center' secondary>
  	<Header as='h1'>Todos</Header>
	<Divider />
    <Add />
    <VisibilityList />
  </Segment>
)

export default App