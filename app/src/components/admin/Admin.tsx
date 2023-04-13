import React, { useEffect, useState } from 'react';
import WrapperBlock from '../../util/WrapperBlock';
import Dropdown from '../../util/Dropdown';
import { useMutation, useQuery } from '@tanstack/react-query';
import { getAllCourseNames } from '../../services/CourseApi';
import Loading from '../../util/Loading';
import useInput from '../../hooks/useInput';
import { createTournament } from '../../services/tournamentsApi';
import { useAuth0 } from '@auth0/auth0-react';
import Error from '../../util/Error';

function Admin() {
  const [selectedCourseIndex, setSelectedCourseIndex] = useState<number>(0);
  const [disableButton, setDisableButton] = useState(false);

  const { user } = useAuth0();

  const toggleButton = () => {
    setDisableButton(!disableButton);
  };

  const {
    value: tournamentName,
    valueChangeHandler: setTournamentName,
    inputBlurHandler: tournamentBlur,
    hasError: tournamentNameError,
    isValid: tournamentNameIsValid,
  } = useInput((value: string) => value.trim() !== '');

  const {
    value: seasonNumber,
    valueChangeHandler: setSeasonNumber,
    inputBlurHandler: seasonNumberBlur,
    hasError: seasonNumberError,
    isValid: seasonNumberIsValid,
  } = useInput((value: number) => value);

  const {
    value: numberOfRounds,
    valueChangeHandler: setNumberOfRounds,
    inputBlurHandler: numberOfRoundsBlur,
    hasError: numberOfRoundsError,
    isValid: numberOfRoundsIsValid,
  } = useInput((value: number) => value);

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

  const addTournament: any = useMutation({
    mutationFn: () =>
      createTournament({
        tournamentName: tournamentName,
        season: Number(seasonNumber),
        numberOfRounds: Number(numberOfRounds),
        courseId: coursesData ? coursesData[selectedCourseIndex].courseId : -1,
      }),
    onMutate: () => toggleButton(),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => toggleButton(),
  });

  useEffect(() => {
    if (tournamentNameIsValid && seasonNumberIsValid && numberOfRoundsIsValid) {
      setDisableButton(false);
    } else {
      setDisableButton(true);
    }
  }, [tournamentNameIsValid, seasonNumberIsValid, numberOfRoundsIsValid]);

  if (coursesAreLoading) {
    return <Loading />;
  }

  if (coursesError) {
    return <Error />;
  }

  if (user?.sub !== 'google-oauth2|115993548271312276661') {
    return (
      <div className="text-center text-dgsoftwhite">
        you do not have admin access
      </div>
    );
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
          <div className="flex justify-center py-1">
            <label>Tournament Name:</label>
            <input
              type="text"
              id="name"
              value={tournamentName}
              className={`rounded px-3 text-black ${
                tournamentNameError ? 'border-2 border-red-400' : ''
              }`}
              onChange={setTournamentName}
              onBlur={tournamentBlur}
            />
          </div>
          <div className="flex justify-center py-1">
            <label>Season Number:</label>
            <input
              className={`rounded px-3 text-black ${
                seasonNumberError ? 'border-2 border-red-400' : ''
              }`}
              type="text"
              id="name"
              value={seasonNumber}
              onChange={setSeasonNumber}
              onBlur={seasonNumberBlur}
            />
          </div>
          <div className="flex justify-center py-1">
            <label>Number of Rounds:</label>
            <input
              className={`rounded px-3 text-black ${
                numberOfRoundsError ? 'border-2 border-red-400' : ''
              }`}
              type="text"
              id="name"
              value={numberOfRounds}
              onChange={setNumberOfRounds}
              onBlur={numberOfRoundsBlur}
            />
          </div>
          <div className="flex justify-center py-1">
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
              disabled={disableButton}
              type="submit"
              className='disabled:text-opacity-10" rounded-md bg-dgtertiary py-2 px-5 text-dgsoftwhite disabled:bg-opacity-10'
              onClick={e => {
                e.preventDefault();
                console.log('clicked');
                addTournament.mutate();
              }}
            >
              Simulate Tournament
            </button>
          </div>
        </form>
        <WrapperBlock color="dgsecondary">
          <div className="text-center">Player Update Numbers</div>
        </WrapperBlock>
      </div>
    );
  }
  return <></>;
}

export default Admin;
