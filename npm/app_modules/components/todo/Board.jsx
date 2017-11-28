import React       from 'react';
import List        from 'components/todo/List';
import Styles      from 'styles/todo';
import { connect } from 'react-redux';

const Board = () => (
    <div className={Styles.project_board}>
        <List status="TODO"> 
            Todo tasks
        </List>
        <List status="DOING"> 
            Doing tasks
        </List>
        <List status="DONE"> 
            Done tasks
        </List>
    </div>
);

export default Board;