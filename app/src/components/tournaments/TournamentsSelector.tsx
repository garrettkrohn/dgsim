import { useQuery } from '@tanstack/react-query';
import {
  getSeasons,
  getTournamentBySeason,
} from '../../services/tournamentsApi';
import TournamentTemplate from './TournamentTemplate';
import { useState } from 'react';
import Modal from '../../util/Modal';
import Button from '../../util/Button';

export default function TournamentsSelector(props: { tournamentId: number }) {
  const [showSeasons, setShowSeasons] = useState(false);
  const [selectedSeason, setSelectedSeason] = useState<number>(1);
  const [showTournaments, setShowTournaments] = useState(false);
  const [selectedTournament, setSelectedTournament] = useState();

  const toggleShowSeasons = () => {
    setShowSeasons(!showSeasons);
  };

  const toggleShowTournament = () => {
    setShowTournaments(!showTournaments);
  };

  const {
    isLoading: sIsLoading,
    error: sError,
    data: sData,
  } = useQuery({
    queryKey: [`seasons`],
    queryFn: () => getSeasons(),
  });

  const {
    isLoading: tIsLoading,
    error: tError,
    data: tData,
  } = useQuery({
    queryKey: [`seasons/tournament`],
    queryFn: () => getTournamentBySeason(selectedSeason),
  });

  if (sIsLoading || tIsLoading) return <div>Loading...</div>;

  if (sError || tError) return <div>An error has occurred</div>;

  const tournamentNames = [];
  //@ts-ignore
  for (let i = 0; i < tData.length; i++) {
    //@ts-ignore
    tournamentNames.push(tData[i].tournamentName);
  }

  return (
    <div>
      <div className="flex h-12 flex-row justify-evenly bg-dgprimary text-dgsoftwhite">
        <Button
          label={'Select Season'}
          onClick={toggleShowSeasons}
          disable={false}
        ></Button>
        {showSeasons ? (
          <Modal
            toggleModal={toggleShowSeasons}
            // @ts-ignore
            items={sData}
            containerStyle={'mt-12'}
            itemStyle={
              'h-12 bg-dgprimary text-dgsoftwhite flex justify-center hover: cursor-pointer'
            }
            title="Select a Season"
            selectItem={setSelectedSeason}
          />
        ) : (
          ''
        )}
        <Button
          label={'Select Tournament'}
          onClick={toggleShowTournament}
          disable={tIsLoading}
        ></Button>
        {showTournaments ? (
          <Modal
            toggleModal={toggleShowTournament}
            items={tournamentNames}
            containerStyle={'mt-12'}
            itemStyle={
              'h-12 bg-dgprimary text-dgsoftwhite flex justify-center hover: cursor-pointer z-100'
            }
            title="Select a Season"
            selectItem={setSelectedTournament}
          />
        ) : (
          ''
        )}
      </div>
      <TournamentTemplate tournamentId={79} />
    </div>
  );
}
