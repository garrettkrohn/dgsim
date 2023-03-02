import PlayerBlock from './PlayerBlock';
import Divider from './Divider';
import UpdateBlock from './UpdateBlock';
import React, { useState } from 'react';
import UpdateConfirmModal from './UpdateConfirmModal';

const Homepage = () => {
  const [showConfirmModal, setShowConfirmModal] = useState(false);

  const toggleConfirmModal = () => {
    setShowConfirmModal(!showConfirmModal);
  };

  return (
    <div>
      <PlayerBlock />
      <Divider color="dgbackground" />
      <UpdateBlock toggleUpdateModal={toggleConfirmModal} />
      {showConfirmModal ? <UpdateConfirmModal /> : ''}
    </div>
  );
};

export default Homepage;
