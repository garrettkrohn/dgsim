import React, { useEffect, useState } from 'react';
import PageLayout from '../PageLayout';
import WrapperBlock from '../../util/WrapperBlock';
import Dropdown from '../../util/Dropdown';
import { useQuery } from '@tanstack/react-query';
import { getPlayer } from '../../services/PlayerApi';
import { getAllCourseNames } from '../../services/CourseApi';
import Loading from '../../util/Loading';

const Admin = () => {
  const [showTournamentCreate, setShowTournamentCreate] = useState(true);
  const [selectedCourseIndex, setSelectedCourseIndex] = useState<number>();

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

    console.log(items);

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
          items={items}
          setIndex={setSelectedCourseIndex}
          title="Select a Course"
        />
        <WrapperBlock color="dgsecondary">
          <div className="text-center">Player Update Numbers</div>
        </WrapperBlock>
      </div>
    );
  }
  return;
};

export default Admin;
