import React       from 'react';
import Styles      from 'styles/todo';
import { connect } from 'react-redux';

const Title = ({ cardsCount }) => (
    <div className={Styles.project_info}>
        <h1>Tasks Board</h1>
        <p>There are {cardsCount} tasks on board</p>
        <span>Type task text and executor name. Click on card to move to another list.</span>
    </div>
);

const mapStateToProps = (state) => {
    return { 
        cardsCount: state.length
    };
};

export default connect(mapStateToProps)(Title);