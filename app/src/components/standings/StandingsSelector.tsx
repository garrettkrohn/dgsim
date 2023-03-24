import React, { useEffect, useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { getSeasonLeaderboards } from '../../services/standingsApi';
import Loading from '../../util/Loading';
import StandingsTemplate from './StandingsTemplate';
import { allSeasonStandings } from '../../services/DTOs';
import Button from '../../util/Button';
import StandingsModal from './StandingsModal';
import Dropdown from '../../util/Dropdown';
import { Simulate } from 'react-dom/test-utils';
import select = Simulate.select;

const StandingsSelector = () => {
  const [seasonNumber, setSeasonNumber] = useState(1);
  const [showSeasons, setShowSeasons] = useState(false);
  const [selectedSeasonIndex, setSelectedSeasonIndex] = useState(-1);

  const toggleShowSeasons = () => {
    setShowSeasons(!showSeasons);
  };

  const {
    isLoading: standingsAreLoading,
    error: standingsError,
    data: standingsData,
    refetch,
  } = useQuery({
    queryKey: [`standings/season`],
    queryFn: () => getSeasonLeaderboards(),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (standingsAreLoading) {
    return <Loading />;
  }

  if (standingsError) {
    return <div>ope, something went wrong</div>;
  }

  if (standingsData) {
    if (selectedSeasonIndex === -1) {
      setSelectedSeasonIndex(standingsData.length - 1);
    }

    const items = standingsData.map(item => {
      return item.season.toString();
    });

    return (
      <div>
        <div className="flex h-16 flex-row justify-evenly bg-dgbackground py-2 text-dgsoftwhite">
          <Dropdown
            items={items}
            setIndex={setSelectedSeasonIndex}
            title={'Select Season'}
          />
        </div>
        <StandingsTemplate
          allSeasonStandings={standingsData[selectedSeasonIndex]}
        />
      </div>
    );
  }

  return <div>error</div>;
};

export default StandingsSelector;
