import React  from 'react';
import Styles from 'styles/todo';

const Card = ({ 
    id, 
    text, 
    executor, 
    onChangeClick,
    onRemoveClick
}) => {
    return (
        <div className={Styles.project_card} onClick={() => onChangeClick(id)}>
            <p className={Styles.card_text}>{text}</p> 
            <span className={Styles.card_executor}>{executor}</span> 
            <span className={Styles.card_remove} onClick={() => onRemoveClick(id)}>-</span>
        </div>
    );
};

export default Card;