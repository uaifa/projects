<?php


namespace App\Repository\Interfaces;

Interface InterfaceStaffMemberRepository{

	public function getAllStaffMembers();
	public function getStaffMemberById($id);
	public function createOrUpdate($id = null, $collection = []);
	public function deleteStaffMember($id);
	public function uploadProfileImage($id, $collection = []);
	public function deleteMultipleStffMembers($collection = []);

}