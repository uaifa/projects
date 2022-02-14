<?php


namespace App\Repository\Interfaces;

Interface InterfaceTeamRepository{

	public function getAllTeams();
	public function getTeamById($id);
	public function createOrUpdate($id = null, $collection = []);
	public function deleteTeam($id);
	public function deleteMultipleTeams($collection = []);

}