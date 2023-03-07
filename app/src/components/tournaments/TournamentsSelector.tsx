import { useQuery } from '@tanstack/react-query';
import {
  getAllTournaments,
  getSeasons,
  getTournamentBySeason,
  getTournamentTitles,
} from '../../services/tournamentsApi';
import TournamentTemplate from './TournamentTemplate';
import { useEffect, useState } from 'react';
import Modal from '../../util/Modal';
import Button from '../../util/Button';
import { tournamentResource } from '../../services/DTOs';

export default function TournamentsSelector(props: { tournamentId: number }) {
  const [showTournaments, setShowTournaments] = useState(false);
  const [selectedTournament, setSelectedTournament] =
    useState<tournamentResource>();

  const toggleShowSeasons = () => {
    setShowTournaments(!showTournaments);
  };

  const {
    isLoading: tournamentsAreLoading,
    error: tournamentsError,
    data: tournamentsData,
    refetch,
  } = useQuery({
    queryKey: [`seasons/tournament/title`],
    queryFn: () => getAllTournaments(),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (tournamentsAreLoading) return <div>Loading...</div>;

  if (tournamentsError) return <div>An error has occurred</div>;

  //@ts-ignore
  // setSelectedTournament(tournamentsData[tournamentsData.length - 1]);

  return (
    <div>
      <div className="flex h-20 flex-row justify-evenly bg-dgprimary text-dgsoftwhite">
        <Button
          label={'Select Tournament'}
          onClick={toggleShowSeasons}
          disable={false}
        ></Button>
        {showTournaments ? (
          <Modal
            toggleModal={toggleShowSeasons}
            // @ts-ignore
            items={tournamentsData}
            containerStyle={'mt-12'}
            itemStyle={
              'h-12 bg-dgprimary text-dgsoftwhite flex justify-center hover: cursor-pointer'
            }
            title="Select a Season"
            selectItem={setSelectedTournament}
          />
        ) : (
          ''
        )}
      </div>
      {selectedTournament ? (
        <TournamentTemplate tournament={selectedTournament} />
      ) : (
        <TournamentTemplate tournament={tournamentsData[0]} />
      )}
    </div>
  );
}
