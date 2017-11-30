import React       from 'react'
import Styles      from 'styles/todo'
import { connect } from 'react-redux'
import { addTodo } from 'apps/actions/todo'
import {
  Form,
  Button,
  Icon
} from 'semantic-ui-react'

let Add = ({ dispatch }) => 
{
  let input

  return (
    <div>
      <Form as='form' onSubmit={
        e =>
        { 
          e.preventDefault()

          if (!input.value.trim()) 
          {
            return
          }
          
          dispatch(addTodo(input.value))
          input.value = ''
        }
      }>
        <Form.Group widths={2}>
          <Form.Field width={15}>
            <input className={Styles.circular} placeholder='Task...' ref={node => { input = node }} />
          </Form.Field>
          <Form.Field width={1}>
            <Button type="submit" color='green' circular icon>
              <Icon name='plus' />
            </Button>
          </Form.Field>
        </Form.Group>
      </Form>
    </div>
  )
}
Add = connect()(Add)

export default Add