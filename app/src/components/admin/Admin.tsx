import React, { FormEvent, useEffect, useState } from 'react';
import WrapperBlock from '../../util/WrapperBlock';
import Dropdown from '../../util/Dropdown';
import { useMutation, useQuery } from '@tanstack/react-query';
import { getAllCourseNames } from '../../services/CourseApi';
import Loading from '../../util/Loading';
import Button from '../../util/Button';
import useInput from '../../hooks/useInput';
import { createTournamentParams } from '../../services/DTOs';
import { data } from 'autoprefixer';
import { createTournament } from '../../services/tournamentsApi';

const Admin = () => {
  const [selectedCourseIndex, setSelectedCourseIndex] = useState<number>(0);

  const {
    value: tournamentName,
    valueChangeHandler: setTournamentName,
    inputBlurHandler: tournamentBlur,
    hasError: tournamentNameError,
    isValid: tournamentNameIsValid,
    reset: tournamentNameReset,
  } = useInput((value: string) => value.trim() !== '');

  const {
    value: seasonNumber,
    valueChangeHandler: setSeasonNumber,
    inputBlurHandler: seasonNumberBlur,
    hasError: seasonNumberError,
    isValid: SeasonNumberIsValid,
    reset: seasonNumberReset,
  } = useInput((value: string) => value.trim() !== '');

  const {
    value: numberOfRounds,
    valueChangeHandler: setNumberOfRounds,
    inputBlurHandler: numberOfRoundsBlur,
    hasError: numberOfRoundsError,
    isValid: numberOfRoundsIsValid,
    reset: numberOfRoundsReset,
  } = useInput((value: string) => value.trim() !== '');

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

    return (
      <div>
        <WrapperBlock color="dgsecondary">
          <div className="text-center">Admin Dashboard</div>
        </WrapperBlock>
        <WrapperBlock color="dgprimary">
          <div className="text-center">Create Tournament</div>
        </WrapperBlock>
        <form className="text-dgsoftwhite">
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
            <input
              className="rounded px-3 text-black"
              type="text"
              id="name"
              value={seasonNumber}
              onChange={setSeasonNumber}
            />
          </div>
          <div className="flex justify-between py-1">
            <label>Number of Rounds:</label>
            <input
              className="rounded px-3 text-black"
              type="text"
              id="name"
              value={numberOfRounds}
              onChange={setNumberOfRounds}
            />
          </div>
          <div className="flex justify-between py-1">
            <div>Select a Course:</div>
            {coursesAreLoading ? <Loading /> : ''}
            {coursesError ? <div>ope, there was an error</div> : ''}
            {coursesData ? (
              <Dropdown
                items={items}
                setIndex={setSelectedCourseIndex}
                title={items[selectedCourseIndex]}
              />
            ) : (
              ''
            )}
          </div>
          <div className="flex justify-center py-1">
            <button
              type="submit"
              className='disabled:text-opacity-10" rounded-md bg-dgtertiary py-2 px-5 text-dgsoftwhite disabled:bg-opacity-10'
              onClick={e => {
                e.preventDefault();
                console.log('clicked');
              }}
            >
              Simulate Tournament
            </button>
          </div>
          {/*<Button*/}
          {/*  label="Simulate Tournament"*/}
          {/*  onClick={simulateTournament}*/}
          {/*  disable={false}*/}
          {/*/>*/}
        </form>
        <WrapperBlock color="dgsecondary">
          <div className="text-center">Player Update Numbers</div>
        </WrapperBlock>
      </div>
    );
  }
  return <></>;
};

export default Admin;
