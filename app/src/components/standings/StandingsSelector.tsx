import React, { useEffect, useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { getSeasonLeaderboards } from '../../services/standingsApi';
import Loading from '../../util/Loading';
import StandingsTemplate from './StandingsTemplate';
import Dropdown from '../../util/Dropdown';
import Error from '../../util/Error';

const StandingsSelector = () => {
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
    return <Error />;
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
