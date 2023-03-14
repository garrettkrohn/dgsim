import { useQuery } from '@tanstack/react-query';
import { getAllTournaments } from '../../services/tournamentsApi';
import TournamentTemplate from './TournamentTemplate';
import React, { useEffect, useState } from 'react';
import TournamentModal from './TournamentModal';
import Button from '../../util/Button';
import { tournamentResource } from '../../services/DTOs';
import Loading from '../../util/Loading';
import Dropdown from '../../util/Dropdown';

export default function TournamentsSelector(props: { tournamentId: number }) {
  const [showTournaments, setShowTournaments] = useState(false);
  const [selectedTournamentId, setSelectedTournamentId] = useState<number>(-1);

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

  if (tournamentsData) {
    const items = tournamentsData.map(item => {
      return item.season + ' - ' + item.tournamentName;
    });

    if (selectedTournamentId === -1) {
      setSelectedTournamentId(tournamentsData.length - 1);
    }

    return (
      <div>
        <div className="flex h-16 flex-row justify-evenly bg-dgbackground py-2 text-dgsoftwhite">
          <Dropdown
            items={items}
            setIndex={setSelectedTournamentId}
            title={'Select Tournament'}
          />
        </div>
        <TournamentTemplate
          tournament={tournamentsData[selectedTournamentId]}
        />
      </div>
    );
  }
}
