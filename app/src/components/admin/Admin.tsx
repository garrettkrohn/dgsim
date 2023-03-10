import React, { useEffect, useState } from 'react';
import WrapperBlock from '../../util/WrapperBlock';
import Dropdown from '../../util/Dropdown';
import { useQuery } from '@tanstack/react-query';
import { getAllCourseNames } from '../../services/CourseApi';
import Loading from '../../util/Loading';
import Button from '../../util/Button';
import useInput from '../../hooks/useInput';

const Admin = () => {
  const [showTournamentCreate, setShowTournamentCreate] = useState(true);
  const [selectedCourseIndex, setSelectedCourseIndex] = useState<number>(0);

  const {
    value: tournamentName,
    valueChangeHandler: setTournamentName,
    inputBlurHandler: blur,
    hasError: tournamentNameError,
    isValid: tournamentNameIsValid,
    reset: tournamentNameReset,
  } = useInput((value: string) => value.trim() !== '');

  // const {
  //   value: seasonNumber,
  //   valueChangeHandler: setseasonNumber,
  //   inputBlurHandler: blurSeason,
  //   hasError: seasonNumberError,
  //   isValid: seasonNumberIsValid,
  //   reset: seasonNumberReset,
  // } = useInput((value: string) => value.trim() !== '');

  const {
    isLoading: coursesAreLoading,
    error: coursesError,
    data: coursesData,
    refetch,
  } = useQuery({
    queryKey: [`courseNames`],
    queryFn: () => getAllCourseNames(),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  useEffect(() => {
    return () => {};
  }, [selectedCourseIndex]);

  if (coursesAreLoading) {
    return <Loading />;
  }

  if (coursesError) {
    return <div>ope, there was an error</div>;
  }

  if (coursesData) {
    const items = coursesData.map(item => {
      return item.courseName;
    });

    const handleSubmit = () => {
      const tournamentParameters = {
        // tournamentName: tournamentName,
        // courseId: items[selectedCourseIndex],
        // season: seasonNumber,
        // numberOfRounds: numberOfRounds,
      };
      console.log(tournamentName);
    };

    const handleTournamentName = (event: Event) => {
      // @ts-ignore
      // setTournamentName(event.target.value);
    };

    return (
      <div>
        <WrapperBlock color="dgsecondary">
          <div className="text-center">Admin Dashboard</div>
        </WrapperBlock>
        <WrapperBlock color="dgprimary">
          <div className="text-center">Create Tournament</div>
        </WrapperBlock>
        <div className="text-dgsoftwhite">
          <div className="flex justify-between py-1">
            <div>Select a Course:</div>
            <Dropdown
              items={items}
              setIndex={setSelectedCourseIndex}
              title={items[selectedCourseIndex]}
            />
          </div>
          <div className="flex justify-between py-1">
            <label>Tournament Name:</label>
            <input
              type="text"
              id="name"
              value={tournamentName}
              className="rounded px-3 text-black"
              onChange={setTournamentName}
            />
          </div>
          <div className="flex justify-between py-1">
            <label>Season Number:</label>
            <input className="rounded px-3 text-black" />
          </div>
          <div className="flex justify-between py-1">
            <label>Number of Rounds:</label>
            <input className="rounded px-3 text-black" />
          </div>
          <Button
            label="Simulate Tournament"
            onClick={handleSubmit}
            disable={false}
          />
        </div>
        <WrapperBlock color="dgsecondary">
          <div className="text-center">Player Update Numbers</div>
        </WrapperBlock>
      </div>
    );
  }
  return;
};

export default Admin;
