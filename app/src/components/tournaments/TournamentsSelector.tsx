import { useQuery } from '@tanstack/react-query';
import {
  getAllTournaments,
  getSeasons,
  getTournamentBySeason,
  getTournamentTitles,
} from '../../services/tournamentsApi';
import TournamentTemplate from './TournamentTemplate';
import { useEffect, useState } from 'react';
import TournamentModal from './TournamentModal';
import Button from '../../util/Button';
import { tournamentResource } from '../../services/DTOs';
import Loading from '../../util/Loading';

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

  if (tournamentsAreLoading) return <Loading />;

  if (tournamentsError) return <div>An error has occurred</div>;

  //@ts-ignore
  // setSelectedTournament(tournamentsData[tournamentsData.length - 1]);

  return (
    <div>
      <div className="flex h-16 flex-row justify-evenly bg-dgbackground text-dgsoftwhite">
        <Button
          label={'Select Tournament'}
          onClick={toggleShowSeasons}
          disable={false}
        ></Button>
        {showTournaments ? (
          <TournamentModal
            toggleModal={toggleShowSeasons}
            // @ts-ignore
            items={tournamentsData}
            containerStyle={'mt-12'}
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
        <TournamentTemplate
          tournament={tournamentsData?.[tournamentsData.length - 1]}
        />
      )}
    </div>
  );
}
