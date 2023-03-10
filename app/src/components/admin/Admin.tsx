import React, { useState } from 'react';
import PageLayout from '../PageLayout';
import WrapperBlock from '../../util/WrapperBlock';
import Dropdown from '../../util/Dropdown';

const Admin = () => {
  const [showTournamentCreate, setShowTournamentCreate] = useState(true);
  const [selectedCourse, setSelectedCourse] = useState<number>();

  console.log(selectedCourse);

  const options = ['opt1', 'opt2', 'opt3'];
  return (
    <div>
      <WrapperBlock color="dgsecondary">
        <div className="text-center">Admin Dashboard</div>
      </WrapperBlock>
      <WrapperBlock color="dgprimary">
        <div className="text-center">Create Tournament</div>
      </WrapperBlock>
      <WrapperBlock color="dgprimary">
        <div>tournament module</div>
      </WrapperBlock>
      <Dropdown
        items={options}
        setIndex={setSelectedCourse}
        title="Select a Course"
      />
      <WrapperBlock color="dgsecondary">
        <div className="text-center">Player Update Numbers</div>
      </WrapperBlock>
    </div>
  );
};

export default Admin;
