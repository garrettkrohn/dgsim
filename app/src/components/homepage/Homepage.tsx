import PlayerBlock from './PlayerBlock';
import Divider from '../../util/Divider';
import UpdateBlock from './UpdateBlock';
import React, { useState } from 'react';
import UpdateConfirmModal from './UpdateConfirmModal';
import LastTournamentBlock from './LastTournamentBlock';
import { useAuth0 } from '@auth0/auth0-react';

const Homepage = () => {
  const [showConfirmModal, setShowConfirmModal] = useState(false);

  const { isAuthenticated } = useAuth0();

  const toggleConfirmModal = () => {
    setShowConfirmModal(!showConfirmModal);
  };

  if (!isAuthenticated) {
    return <div className="text-dgsoftwhite">please log in</div>;
  }

  try {
    //get the user by the token
  } catch {
    //create the user if it doesn't exist
  }

  try {
    //pulling the player from the user
  } catch {
    //reroute to create a player if the player doesn't exist
  }

  return (
    <div>
      <PlayerBlock />
      <Divider color="dgbackground" />
      <UpdateBlock toggleUpdateModal={toggleConfirmModal} />
      {showConfirmModal ? (
        <UpdateConfirmModal toggleModal={toggleConfirmModal} />
      ) : (
        ''
      )}
      <LastTournamentBlock />
    </div>
  );
};

export default Homepage;
